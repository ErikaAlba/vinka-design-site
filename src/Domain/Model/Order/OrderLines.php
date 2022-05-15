<?php

namespace App\Domain\Model\Order;

use App\Domain\Model\Order;
use App\Domain\Model\Product\Product;
use App\Infrastructure\Repository\Order\OrderLinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLinesRepository::class)]
class OrderLines
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'product_id')]
    private $product;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $totalPrice;

    #[ORM\Column(type: 'integer')]
    private $totalBasePrice;

    #[ORM\Column(type: 'float')]
    private $rate;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderEntity;

    /**
     * Constructor
     */
    public function __construct(
        string $id,
        Product $product,
        int $quantity,
        string $name,
        int $totalPrice,
        int $totalBasePrice,
        float $rate,
        Order $orderEntity
    )
    {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->totalBasePrice = $totalBasePrice;
        $this->rate = $rate;
        $this->orderEntity = $orderEntity;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getTotalBasePrice(): ?int
    {
        return $this->totalBasePrice;
    }

    public function setTotalBasePrice(int $totalBasePrice): self
    {
        $this->totalBasePrice = $totalBasePrice;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getOrderEntity(): ?Order
    {
        return $this->orderEntity;
    }

    public function setOrderEntity(?Order $orderEntity): self
    {
        $this->orderEntity = $orderEntity;

        return $this;
    }
}
