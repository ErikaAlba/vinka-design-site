<?php

namespace App\EntryPoint\Controller\Site\ShoppingCart;


use App\Application\Cart\Command\AddItem\AddItemCommand;
use App\Application\Cart\Command\AddItem\AddItemCommandHandler;
use App\Domain\Model\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\UuidV4;

class AddItemController extends AbstractController
{

    private AddItemCommandHandler $addItemCommandHandler;

    public function __construct(AddItemCommandHandler $addItemCommandHandler)
    {
        $this->addItemCommandHandler = $addItemCommandHandler;
    }

    #[Route('/add/item', name: 'app_add_item')]
    public function index(Request $request): Response
    {
        $productId = $request->get('idProduct');
        $cartId = $request->getSession()->get('cartId');
        if($cartId == null){
            $cartId = UuidV4::v4()->jsonSerialize();
            $request->getSession()->set('cartId', $cartId);
        }

        /** @var User $user */
        $user = $this->getUser();
        if($user == null){
            return $this->redirectToRoute('app_login');
        }

        $this->addItemCommandHandler->handle(new AddItemCommand($productId, $cartId, $user->getId(),1));
        return $this->redirectToRoute('app_cart');
    }
}
