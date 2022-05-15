<?php

namespace App\Application\Cart\Query\GetCart;

class GetCartQuery
{
    private string $cartId;
    private string $userId;

    public function __construct(string $cartId, string $userId)
    {
        $this->cartId = $cartId;
        $this->userId = $userId;
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }




}