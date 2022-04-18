<?php

namespace App\Application\Product\Query\GetProductListQuery;

use App\Infrastructure\Repository\Product\ProductRepository;

class GetProductListQueryHandler
{

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductListQuery $query)
    {
        return $this->productRepository->findByFamilyName($query->getFamilyName(),$query->getResults());
    }
}