<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\CategoryTree;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{

    #[Route('/api/products/{page}', defaults: ['page' => 1], name: 'get_all_products', methods: ['GET'])]
    public function getAllProducts($page, ProductRepository $repository, Request $request): Response
    {
        $pricelist = $request->query->get('pricelist');
        $user = $request->query->get('user');

        if ($pricelist == null)
            $pricelist = 0;
        if ($user == null)
            $user = 0;

        $products = $repository->findAllProducts($page, $pricelist, $user);

        $data = [];

        foreach ($products as $product) {
            array_push($data, $product);
        }

        return $this->json($data);
    }

    #[Route('/api/products/category={category}/{page}', defaults: ['category' => 1, 'page' => 1], name: 'get_products_by_category', methods: ['GET'])]
    public function getProductsByCategory($page, $category, CategoryTree $categories, ProductRepository $repository, Request $request): Response
    {
        $ids = $categories->getChildIds($category);
        array_push($ids, $category);

        $pricelist = $request->query->get('pricelist');
        $user = $request->query->get('user');

        if ($pricelist == null)
            $pricelist = 0;
        if ($user == null)
            $user = 0;

        $products = $repository->findByCategory($page, $pricelist, $user, $ids);
        $data = [];

        foreach ($products as $product) {
            array_push($data, $product);
        }

        return $this->json($data);
    }

    #[Route('/api/product={id}', defaults: ['id' => 1], name: 'get_products_by_id', methods: ['GET'])]
    public function getProductsById(int $id, ProductRepository $repository, Request $request): Response
    {
        $pricelist = $request->query->get('pricelist');
        $user = $request->query->get('user');

        if ($pricelist == null)
            $pricelist = 0;
        if ($user == null)
            $user = 0;

        $product = $repository->findByProductId(1, $pricelist, $user, $id);

        if (!$product) {
            return $this->json('No product found for id = ' . $id, 404);
        }

        $data = [];

        foreach ($product as $p) {
            array_push($data, $p);
        }

        return $this->json($data);
    }


    #[Route('/api/products/search/{page}', methods: ['GET'])]
    public function getProductsBySearch($page, ProductRepository $repository, Request $request): Response
    {

        $pricelist = $request->query->get('pricelist');
        $user = $request->query->get('user');
        $term = $request->query->get('term');
        $category = $request->query->get('category');
        $sortBy = $request->query->get('sortBy');
        $sortOrder = $request->query->get('sortOrder');
        $minPrice = $request->query->get('minPrice');
        $maxPrice = $request->query->get('maxPrice');

        if ($pricelist == null)
            $pricelist = 0;
        if ($user == null)
            $user = 0;
        if ($term == null)
            $term = '';
        if ($category == null)
            $category = 0;
        if ($sortBy == null)
            $sortBy = 'id';
        if ($sortOrder == null)
            $sortOrder = 'ASC';
        if ($minPrice == null)
            $minPrice = 0;
        if ($maxPrice == null)
            $maxPrice = 0;

        $products = $repository->findBySearch($page, $pricelist, $user, $term, $category, $sortBy, $sortOrder, $minPrice, $maxPrice);

        $data = [];

        foreach ($products as $product) {
            array_push($data, $product);
        }

        return $this->json($data);
    }
}
