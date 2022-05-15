<?php

namespace App\EntryPoint\Controller\Site\ShoppingCart;

use App\Application\Cart\Query\GetCart\GetCartQuery;
use App\Application\Cart\Query\GetCart\GetCartQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    private GetCartQueryHandler $cartQueryHandler;

    public function __construct(GetCartQueryHandler $cartQueryHandler)
    {
        $this->cartQueryHandler = $cartQueryHandler;
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request): Response
    {
        $cartId = $request->getSession()->get('cartId');
        $user = $this->getUser();
        $cart = $this->cartQueryHandler->handle(new GetCartQuery($cartId,$user->getId()));
        return $this->render('checkout/index.html.twig', [
            'cart' => $cart,
        ]);
    }
}
