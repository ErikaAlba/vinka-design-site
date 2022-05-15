<?php

namespace App\Application\Cart\Query\GetCart;

use App\Domain\Model\Cart\Cart;
use App\Infrastructure\Repository\Cart\CartRepository;
use App\Infrastructure\Repository\User\UserRepository;

class GetCartQueryHandler
{
    private CartRepository $cartRepository;
    private UserRepository $userRepository;

    public function __construct(CartRepository $cartRepository, UserRepository $userRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(GetCartQuery $query)
    {
        $cart = $this->cartRepository->findByIdWithProducts($query->getCartId());

        if ($cart == null) {
            $user = $this->userRepository->findById($query->getUserId());
            return new Cart($query->getCartId(), $user);
        }
        if ($query->getCartId() == null || $cart->getUser()->getId() != $query->getUserId()) {
            throw new \Exception('user no allowed to this cart');
        }

        return $cart;

    }

}