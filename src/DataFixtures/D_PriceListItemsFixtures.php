<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\PriceList;
use App\Entity\PriceListItems;
use App\Entity\Product;

class D_PriceListItemsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $products = $manager->getRepository(Product::class)->findAll();
        $products_count = count($products);

        $price_list = $manager->getRepository(PriceList::class)->findAll();
        $price_list_count = count($price_list);

        for ($i = 0; $i < $price_list_count; $i++) {
            for ($j = 0; $j < $products_count; $j++) {

                $price_list_items = new PriceListItems();
                $price_list_items->setPriceList($price_list[$i]);
                $price_list_items->setProduct($products[$j]);
                $price_list_items->setPrice(mt_rand(5, 1000));

                $manager->persist($price_list_items);
            }
        }

        $manager->flush();
    }
}
