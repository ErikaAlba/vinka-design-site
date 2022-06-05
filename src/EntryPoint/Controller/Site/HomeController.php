<?php

namespace App\EntryPoint\Controller\Site;

use App\Application\Family\Query\GetFamiliesQuery\GetFamiliesQuery;
use App\Application\Family\Query\GetFamiliesQuery\GetFamiliesQueryHandler;
use App\Application\Product\Query\GetProductListQuery\GetProductListQuery;
use App\Application\Product\Query\GetProductListQuery\GetProductListQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private GetFamiliesQueryHandler $getFamiliesQueryHandler;
    private GetProductListQueryHandler $getProductListQueryHandler;

    public function __construct(
        GetFamiliesQueryHandler $getFamiliesQueryHandler,
        GetProductListQueryHandler $getProductListQueryHandler
    ) {
        $this->getFamiliesQueryHandler = $getFamiliesQueryHandler;
        $this->getProductListQueryHandler = $getProductListQueryHandler;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $families = $this->getFamiliesQueryHandler->handle(new GetFamiliesQuery());

        $tocados = $this->getProductListQueryHandler->handle(new GetProductListQuery('tocados',20));
        $pamelas = $this->getProductListQueryHandler->handle(new GetProductListQuery('pamelas',20));
        $pajaritas = $this->getProductListQueryHandler->handle(new GetProductListQuery('pajaritas',20));

        return $this->render('home/index.html.twig', [
            'families' => $families,
            'tocados' => $tocados,
            'pamelas'=> $pamelas,
            'pajaritas'=> $pajaritas
        ]);

    }
}
