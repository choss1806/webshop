<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tax;


class E_TaxFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tax = new Tax();
        $tax->setName("PDV 25%");
        $tax->setTaxPercent(0.25);
        $tax->setActive(true);
        $manager->persist($tax);
        $manager->flush();
    }
}
