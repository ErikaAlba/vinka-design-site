<?php

namespace App\EntryPoint\Controller\Site\Product;

use App\Application\Product\Query\GetProductBySlug\GetProductBySlugQuery;
use App\Application\Product\Query\GetProductBySlug\GetProductBySlugQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPageController extends AbstractController
{
    private GetProductBySlugQueryHandler $bySlugQueryHandler;

    public function __construct(GetProductBySlugQueryHandler $bySlugQueryHandler)
    {
        $this->bySlugQueryHandler = $bySlugQueryHandler;
    }

    #[Route('/product/{slug}', name: 'app_product_page')]
    public function index(string $slug): Response
    {
        $product = $this->bySlugQueryHandler->handle(new GetProductBySlugQuery($slug));
        #dump($product);
        return $this->render('product_page/index.html.twig', [
            'product' => $product,
        ]);
    }
}
