<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ContractList;
use App\Entity\Product;
use App\Entity\User;


class I_ContractListFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $products = $manager->getRepository(Product::class)->findAll();
        $products_count = count($products);

        $users = $manager->getRepository(User::class)->findAll();
        $users_count = count($users);

        $number_of_products = 30;

        for ($i = 1; $i <= $number_of_products; $i++) {

            $contract_list = new ContractList();
            $contract_list->setProduct($products[$i]);
            $contract_list->setUser($users[mt_rand(0, $users_count - 1)]);
            $contract_list->setPrice(mt_rand(2, 123));
            $manager->persist($contract_list);
        }

        $manager->flush();
    }
}
