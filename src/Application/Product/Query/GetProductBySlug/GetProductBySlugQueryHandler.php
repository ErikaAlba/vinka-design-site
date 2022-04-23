<?php

namespace App\Application\Product\Query\GetProductBySlug;

use App\Domain\Model\Product\Exceptions\SlugNotFoundException;
use App\Infrastructure\Repository\Product\ProductRepository;
use http\Exception;

class GetProductBySlugQueryHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductBySlugQuery $query)
    {
        $product = $this->productRepository->findBySlug($query->getSlug());
        if($product == null){
            throw new SlugNotFoundException($query->getSlug());
        }
        return $product;
    }
}