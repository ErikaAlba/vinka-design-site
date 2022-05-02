<?php

namespace App\Application\Cart\Command\AddItem;

class AddItemCommand
{
    private string $productId;
    private string $cartId;
    private string $userId;
    private int $quantity;

    /**
     * @param string $productId
     * @param string $cartId
     * @param string $userId
     */
    public function __construct(string $productId, string $cartId, string $userId , int $quantity)
    {
        $this->productId = $productId;
        $this->cartId = $cartId;
        $this->userId = $userId;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getCartId(): string
    {
        return $this->cartId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }



}