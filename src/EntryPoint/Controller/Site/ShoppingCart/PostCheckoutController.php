<?php

namespace App\EntryPoint\Controller\Site\ShoppingCart;

use App\Application\Order\Command\AddOrderCommand;
use App\Application\Order\Command\AddOrderCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostCheckoutController extends AbstractController
{
    private AddOrderCommandHandler $addOrderCommandHandler;

    public function __construct(AddOrderCommandHandler $addOrderCommandHandler)
    {
        $this->addOrderCommandHandler = $addOrderCommandHandler;
    }

    #[Route('/post/checkout', name: 'app_post_checkout')]
    public function index(Request $request): Response
    {
        $cartId = $request->getSession()->get('cartId');
        $this->addOrderCommandHandler->handle(
            new AddOrderCommand(
                $cartId,
                $request->get('name'),
                $request->get('last_name'),
                'ES',
                $request->get('address'),
                $request->get('city'),
                $request->get('floor'),
                $request->get('number'),
                $request->get('zip_code'),
                $request->get('phone'),
                'Transferencia'
            )
        );
        return new Response();
    }
}
