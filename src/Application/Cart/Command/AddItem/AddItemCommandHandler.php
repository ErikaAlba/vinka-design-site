<?php

namespace App\Application\Cart\Command\AddItem;

use App\Domain\Model\Cart\Cart;
use App\Domain\Model\Cart\CartLine;
use App\Infrastructure\Repository\Cart\CartRepository;
use App\Infrastructure\Repository\Product\ProductRepository;
use App\Infrastructure\Repository\User\UserRepository;
use Symfony\Component\Uid\UuidV4;

class AddItemCommandHandler
{
    private CartRepository $cartRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(CartRepository $cartRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function handle(AddItemCommand $command)
    {
        $cart = $this->cartRepository->findById($command->getCartId());
        $user = $this->userRepository->findById($command->getUserId());
        if ($user == null) {
            throw new \Exception('user not found');
        }
        if ($cart == null) {
            $cart = new Cart($command->getCartId(), $user);
        }

        if ($cart->getUser()->getId() != $command->getUserId()) {
            throw new \Exception('user not allowed to add items in this cart');
        }
        $product = $this->productRepository->findById($command->getProductId());
        if ($product == null) {
            throw new \Exception('product not found');
        }
        $cartLine = new CartLine(
            UuidV4::v4()->jsonSerialize(),
            $product,
            $command->getQuantity(),
            $product->name(),
            $cart
        );

        $cart->addCartLine($cartLine);
        $this->cartRepository->add($cart);
    }


}