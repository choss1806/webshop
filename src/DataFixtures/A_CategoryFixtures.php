<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class A_CategoryFixtures  extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadMainCategories($manager);
        $this->loadElectronics($manager);
        $this->loadComputers($manager);
        $this->loadLaptops($manager);
        $this->loadBooks($manager);
        $this->loadMovies($manager);
        $this->loadHorror($manager);
    }

    private function loadMainCategories($manager)
    {
        foreach ($this->getMainCategoriesData() as [$name, $decription]) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($decription);
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function loadElectronics($manager)
    {
        $this->loadSubcategories($manager, 'Electronics', 1);
    }

    private function loadComputers($manager)
    {
        $this->loadSubcategories($manager, 'Computers', 6);
    }

    private function loadLaptops($manager)
    {
        $this->loadSubcategories($manager, 'Laptops', 8);
    }

    private function loadBooks($manager)
    {
        $this->loadSubcategories($manager, 'Books', 3);
    }

    private function loadMovies($manager)
    {
        $this->loadSubcategories($manager, 'Movies', 4);
    }

    private function loadHorror($manager)
    {
        $this->loadSubcategories($manager, 'Horror', 18);
    }

    private function loadSubcategories($manager, $category, $parent_id)
    {
        $parent = $manager->getRepository(Category::class)->find($parent_id);
        $methodName = "get{$category}Data";
        foreach ($this->$methodName() as [$name, $description]) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($description);
            $category->setParent($parent);
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function getMainCategoriesData()
    {
        return [
            ['Electronics', 'Decription of Electronics', 1],
            ['Toys', 'Decription of Toys', 2],
            ['Books', 'Decription of Books', 3],
            ['Movies', 'Decription of Movies', 4],
        ];
    }

    private function getElectronicsData()
    {
        return [
            ['Cameras', 'Decription of Cameras', 5],
            ['Computers', 'Decription of Computers', 6],
            ['Cell Phones', 'Decription of Cell Phones', 7]
        ];
    }

    private function getComputersData()
    {
        return [
            ['Laptops', 'Decription of Laptops', 8],
            ['Desktops', 'Decription of Desktops', 9]
        ];
    }

    private function getLaptopsData()
    {
        return [
            ['Apple', 'Decription of Apple', 10],
            ['Asus', 'Decription of Asus', 11],
            ['Dell', 'Decription of Dell', 12],
            ['Lenovo', 'Decription of Lenovo', 13],
            ['HP', 'Decription of HP', 14]
        ];
    }

    private function getBooksData()
    {
        return [
            ['Children\'s Books', 'Decription of Children\'s Books', 15],
            ['Kindle eBooks', 'Decription of Kindle eBooks', 16],
        ];
    }

    private function getMoviesData()
    {
        return [
            ['Family', 'Decription of Family', 17],
            ['Horror', 'Decription of Horror', 18],
        ];
    }

    private function getHorrorData()
    {
        return [
            ['Horror Slasher', 'Decription of Horror Slasher', 19],
            ['Horror Gore', 'Decription of Horror Gore', 20],
        ];
    }
}
