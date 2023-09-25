<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Category;

class B_ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $number_of_products = 500;

        $categories = $manager->getRepository(Category::class)->findAll();
        $category_count = count($categories);

        for ($i = 1; $i <= $number_of_products; $i++) {

            $random_number_categories = mt_rand(1, 5);

            $product = new Product();
            $product->setName('Product #' . $i);
            $product->setPrice(mt_rand(5, 1000));
            $product->setDescription('Description of product #' . $i);
            $product->setSKU('SKU-' . sprintf("%010d", $i));
            $product->setPublished((bool)random_int(0, 1));
            for ($j = 1; $j <= $random_number_categories; $j++) {
                $product->setCategory($categories[mt_rand(0, $category_count - 1)]);
            }
            $manager->persist($product);
        }

        $manager->flush();
    }
}
