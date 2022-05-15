<?php

namespace App\Application\Cart\Command\DeleteItem;

class DeleteItemCommand
{
    private string $carLineId;
    private string $cartId;
    private string $userId;

    public function __construct(string $carLineId, string $cartId, string $userId)
    {
        $this->carLineId = $carLineId;
        $this->cartId = $cartId;
        $this->userId = $userId;
    }

    public function getCarLineId(): string
    {
        return $this->carLineId;
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