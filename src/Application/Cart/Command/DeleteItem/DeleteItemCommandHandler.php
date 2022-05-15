<?php

namespace App\Application\Cart\Command\DeleteItem;

use App\Infrastructure\Repository\Cart\CartRepository;

class DeleteItemCommandHandler
{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function handle(DeleteItemCommand $command)
    {
        $cart = $this->cartRepository->findById($command->getCartId());

        if ($cart == null) {
            throw new \Exception('Cart not found');
        }

        if ($cart->getUser()->getId() != $command->getUserId()) {
            throw new \Exception('user not allowed to add items in this cart');
        }

        $line = $cart->getCarlineById($command->getCarLineId());

        if ($line == null) {
            throw new \Exception('Line not found');
        }

        $cart->removeCartLine($line);

        $this->cartRepository->add($cart);
    }


}