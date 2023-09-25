<?php

namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use App\Utils\Cats;

abstract class CategoryTreeAbstract
{

    public $categoriesArrayFromDb;
    protected static $dbconnection;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
        $this->categoriesArrayFromDb = $this->getCategories();
        $this->registry = $registry;
    }

    abstract public function getCategoryList(array $categories_array);

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
