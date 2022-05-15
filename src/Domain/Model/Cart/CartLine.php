<?php

namespace App\Domain\Model\Cart;


use App\Infrastructure\Repository\Cart\CartLineRepository;
use Doctrine\ORM\Mapping as ORM;
use \App\Domain\Model\Product\Product;

#[ORM\Entity(repositoryClass: CartLineRepository::class)]
class CartLine
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

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $cart;

    public function __construct(string $id, Product $product, int $quantity, string $name, Cart $cart)
    {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->name = $name;
        $this->cart = $cart;
    }

    public function getId(): ?string
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

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
