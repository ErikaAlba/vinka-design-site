<?php

namespace App\EntryPoint\Controller\Site\ShoppingCart;

use App\Application\Cart\Command\DeleteItem\DeleteItemCommand;
use App\Application\Cart\Command\DeleteItem\DeleteItemCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    private DeleteItemCommandHandler $deleteItemCommandHandler;

    public function __construct(DeleteItemCommandHandler $deleteItemCommandHandler)
    {
        $this->deleteItemCommandHandler = $deleteItemCommandHandler;
    }

    #[Route('/delete/item', name: 'app_delete_item')]
    public function index(Request $request): Response
    {
        $cartId = $request->getSession()->get('cartId');
        $user = $this->getUser();
        $this->deleteItemCommandHandler->handle(new DeleteItemCommand(
            $request->get('remove'),
            $cartId,
            $user->getId()
        ));
        return $this->redirectToRoute('app_cart');
    }
}
