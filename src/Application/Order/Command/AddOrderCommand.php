<?php

namespace App\Application\Order\Command;

class AddOrderCommand
{
   private string $cartId;
   private string $name;
   private string $lastName;
    private string $country;
    private string $address;
    private string $city;
    private string $floor;
    private int $number;
    private string $zipCode;
    private string $phone;
    private string $payment;

    public function __construct(string $cartId, string $name, string $lastName, string $country, string $address, string $city, string $floor, int $number, string $zipCode, string $phone, string $payment)
    {
        $this->cartId = $cartId;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->country = $country;
        $this->address = $address;
        $this->city = $city;
        $this->floor = $floor;
        $this->number = $number;
        $this->zipCode = $zipCode;
        $this->phone = $phone;
        $this->payment = $payment;
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }




}