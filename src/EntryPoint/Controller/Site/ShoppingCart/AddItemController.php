<?php

namespace App\EntryPoint\Controller\Site\ShoppingCart;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddItemController extends AbstractController
{
    #[Route('/add/item', name: 'app_add_item')]
    public function index(Request $request): Response
    {
        $producId = $request->get('idProduct');
//        dump(($producId));
        return $this->render('add_item/index.html.twig', [
            'controller_name' => 'AddItemController',
        ]);
    }
}
