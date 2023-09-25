<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\PriceList;

class C_PriceListFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $number_of_price_list = 5;

        for ($i = 1; $i <= $number_of_price_list; $i++) {
            $price_list = new PriceList();
            $price_list->setName('Price List #' . $i);
            $manager->persist($price_list);
        }

        $manager->flush();
    }
}
