<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Discount;


class F_DiscountFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $discount = new Discount();
        $discount->setName("Popust 10%");
        $discount->setDiscountPercent(0.1);
        $discount->setActive(true);
        $manager->persist($discount);
        $manager->flush();
    }
}
