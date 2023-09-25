<?php

namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;

abstract class CategoryTreeAbstract
{

    public $categoriesArrayFromDb;
    protected static $dbconnection;

    public function __construct(EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
        $this->categoriesArrayFromDb = $this->getCategories();
    }

    private function getCategories(): array
    {
        if (self::$dbconnection) {
            return self::$dbconnection;
        } else {

            $connection = $this->entitymanager->getConnection();
            $statement = $connection->prepare('SELECT id, parent_id FROM category');
            $result = $statement->executeQuery();

            $ids = [];
            while (($row = $result->fetchAssociative()) !== false) {
                array_push($ids, $row);
            }
            return $ids;
        }
    }
}
