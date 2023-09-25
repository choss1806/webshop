<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Order;
use App\Entity\OrderItems;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Repository\DiscountRepository;
use App\Repository\TaxRepository;
use App\Repository\UserAddressRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderController extends AbstractController
{

    #[Route('/api/order', name: 'post_order', methods: ['POST'])]
    public function postOrder(UserRepository $user_repo, ProductRepository $product_repo, TaxRepository $tax_repo, DiscountRepository $discount_repo, UserAddressRepository $address_repo,  Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user_id = $request->request->get('user_id');
        $address_id = $request->request->get('address_id');

        $user = $user_repo->find($user_id);
        $user_address = $address_repo->find($address_id);
        $discount = $discount_repo->findActiveDiscount();
        $tax = $tax_repo->findActiveTaxt();
        $orders = $request->request->all('order');

        $order_details = new Order();
        $order_details->setUser($user);
        $order_details->setPrice(0);
        $order_details->setPriceDiscount(0);
        $order_details->setPriceTotal(0);
        $order_details->setAddressHolder($user_address->getAddressHolder());
        $order_details->setAddressLine1($user_address->getAddressLine1());
        $order_details->setAddressLine2($user_address->getAddressLine2());
        $order_details->setCity($user_address->getCity());
        $order_details->setPostalCode($user_address->getPostalCode());
        $order_details->setCountry($user_address->getCountry());
        $order_details->setPhone($user_address->getPhone());
        $order_details->setEmail($user->getEmail());

        $entityManager->persist($order_details);
        $entityManager->flush();

        $count_total = 0;

        foreach ($orders as $order) {
            $product = $product_repo->find($order["product_id"]);
            $price = $order["price"];
            $quantity = $order["quantity"];
            $price_taxed = $price * ($tax[0]->getTaxPercent() + 1);
            $price_total = $price_taxed * $quantity;

            $order_item = new OrderItems();
            $order_item->setProduct($product);
            $order_item->setOrderDetails($order_details);
            $order_item->setPrice($price);
            $order_item->setPriceTaxed($price_taxed);
            $order_item->setQuantity($quantity);
            $order_item->setPriceTotal($price_total);
            $entityManager->persist($order_item);

            $count_total = $count_total + $price_total;
        }

        $entityManager->flush();

        $order_details->setPrice($count_total);
        $discount_price = 0;
        if ($count_total >= 100) {
            $discount_price = $count_total * $discount[0]->getDiscountPercent();
        }
        $order_details->setPriceDiscount($discount_price);
        $order_details->setPriceTotal($count_total - $discount_price);
        $entityManager->persist($order_details);
        $entityManager->flush();

        $result[] = [
            'id' => $order_details->getId(),
            'price' => $order_details->getPrice(),
            'price_discount' => $order_details->getPriceDiscount(),
            'price_total' => $order_details->getPriceTotal(),
            'address_holder' => $order_details->getAdressHolder(),
            'address_line1' => $order_details->getAddressLine1(),
            'address_line2' => $order_details->getAddressLine2(),
            'city' => $order_details->getCity(),
            'postal_code' => $order_details->getPostalCode(),
            'country' => $order_details->getCountry(),
            'phone' => $order_details->getPhone(),
            'e_mail' => $order_details->getEmail(),
        ];

        return $this->json($result);
    }
}
