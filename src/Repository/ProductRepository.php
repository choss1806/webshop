<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Product::class);
        $this->paginator = $paginator;
    }

    public function findAllProducts(int $page, int $pricelist, int $user)
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class, 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'description', 'description');
        $rsm->addFieldResult('p', 'price', 'price');
        $rsm->addFieldResult('p', 'sku', 'SKU');
        $rsm->addFieldResult('p', 'published', 'published');

        $query = $this->getEntityManager()->createNativeQuery('CALL spGetAllProducts(:p_price_list_id, :p_user_id)', $rsm);
        $query->setParameter('p_price_list_id', $pricelist);
        $query->setParameter('p_user_id', $user);

        $products = $query->getArrayResult();

        $pagination = $this->paginator->paginate($products, $page, 25);
        return $pagination;
    }

    public function findByCategory(int $page, int $pricelist, int $user, array $ids)
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class, 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'description', 'description');
        $rsm->addFieldResult('p', 'price', 'price');
        $rsm->addFieldResult('p', 'sku', 'SKU');
        $rsm->addFieldResult('p', 'published', 'published');

        $query = $this->getEntityManager()->createNativeQuery('CALL spGetProductsByCategory(:p_price_list_id, :p_user_id, :p_category_ids)', $rsm);
        $query->setParameter('p_price_list_id', $pricelist);
        $query->setParameter('p_user_id', $user);
        $query->setParameter('p_category_ids', implode($ids));

        $product = $query->getArrayResult();

        $pagination = $this->paginator->paginate($product, $page, 25);
        return $pagination;
    }

    public function findByProductId(int $page, int $pricelist, int $user, int $id)
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class, 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'description', 'description');
        $rsm->addFieldResult('p', 'price', 'price');
        $rsm->addFieldResult('p', 'sku', 'SKU');
        $rsm->addFieldResult('p', 'published', 'published');

        $query = $this->getEntityManager()->createNativeQuery('CALL spGetProductById(:p_price_list_id, :p_user_id, :p_product_id)', $rsm);
        $query->setParameter('p_price_list_id', $pricelist);
        $query->setParameter('p_user_id', $user);
        $query->setParameter('p_product_id', $id);

        $product = $query->getArrayResult();

        $pagination = $this->paginator->paginate($product, $page, 25);
        return $pagination;
    }

    public function findBySearch(int $page, int $pricelist, int $user, string $search, int $category_id, string $sort_by, string $sort_order, float $price_min, float $price_max)
    {
        #spGetProductsByCategory
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class, 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'description', 'description');
        $rsm->addFieldResult('p', 'price', 'price');
        $rsm->addFieldResult('p', 'sku', 'SKU');
        $rsm->addFieldResult('p', 'published', 'published');

        $query = $this->getEntityManager()->createNativeQuery('CALL spGetProdutcsBySearch(:p_price_list_id, :p_user_id, :p_search_name, :p_search_category, :p_sort_by, :p_sort_order, :p_price_min, :p_price_max)', $rsm);
        $query->setParameter('p_price_list_id', $pricelist);
        $query->setParameter('p_user_id', $user);
        $query->setParameter('p_search_name', $search);
        $query->setParameter('p_search_category', $category_id);
        $query->setParameter('p_sort_by', $sort_by);
        $query->setParameter('p_sort_order', $sort_order);
        $query->setParameter('p_price_min', $price_min);
        $query->setParameter('p_price_max', $price_max);

        $product = $query->getArrayResult();

        $pagination = $this->paginator->paginate($product, $page, 25);
        return $pagination;
    }
}
