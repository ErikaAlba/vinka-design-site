<?php

namespace App\Application\Order\Command;

use App\Domain\Model\Order;
use App\Domain\Model\Order\OrderLines;
use App\Infrastructure\Repository\Cart\CartRepository;
use App\Infrastructure\Repository\Order\OrderRepository;
use App\Infrastructure\Repository\Product\ProductRepository;
use Symfony\Component\Uid\UuidV4;

class AddOrderCommandHandler
{
    private CartRepository $cartRepository;
    private OrderRepository $orderRepository;

    public function __construct(CartRepository $cartRepository, OrderRepository $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    public function handle(AddOrderCommand $command)
    {
        $cart = $this->cartRepository->findById($command->getCartId());
        $order = new Order(
            UuidV4::v4()->jsonSerialize(),
            $cart->totalPrice() * 100,
            $this->calculateBasePrice($cart->totalPrice() * 100, Order::DEFAULT_RATE),
            $cart->shippingCost() * 100,
            $command->getName(),
            $command->getLastName(),
            $cart->getUser(),
            $command->getCountry(),
            $command->getAddress(),
            $command->getCity(),
            $command->getFloor(),
            $command->getNumber(),
            $command->getZipCode(),
            $command->getPhone(),
            $command->getPayment(),
            Order::INITIAL_STATUS
        );

        foreach ($cart->getCartLines() as $cartLine) {
            $order->addOrderLine(new OrderLines(
                UuidV4::v4()->jsonSerialize(),
                $cartLine->getProduct(),
                $cartLine->getQuantity(),
                $cartLine->getName(),
                $cartLine->getProduct()->getPrice() * $cartLine->getQuantity(),
                $this->calculateBasePrice($cartLine->getProduct()->getPrice(), Order::DEFAULT_RATE),
                Order::DEFAULT_RATE,
                $order
            ));
        }

       $this->orderRepository->add($order);
    }

    private function calculateBasePrice(int $netPrice, float $rate)
    {
        return round($netPrice / (($rate / 100) + 1));
    }

}