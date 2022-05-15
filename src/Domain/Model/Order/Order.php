<?php

namespace App\Domain\Model;

use App\Domain\Model\Order\OrderLines;
use App\Domain\Model\User\User;
use App\Infrastructure\Repository\Order\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    public const DEFAULT_RATE = 21;
    public const INITIAL_STATUS = 'NEW';

    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $total;

    #[ORM\Column(type: 'integer')]
    private $totalBase;

    #[ORM\Column(type: 'integer')]
    private $shippingCost;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $floor;

    #[ORM\Column(type: 'string', length: 255)]
    private $number;

    #[ORM\Column(type: 'string', length: 255)]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $payment;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderLines::class, cascade: ['all'], orphanRemoval: true)]
    private $orderLines;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    public function __construct(
        string $id,
        int    $total,
        int    $totalBase,
        int    $shippingCost,
        string $name,
        string $lastName,
        User   $user,
        string $country,
        string $address,
        string $city,
        string $floor,
        string $number,
        string $zipCode,
        string $phone,
        string $payment,
        string $status
    )
    {
        $this->id = $id;
        $this->total = $total;
        $this->totalBase = $totalBase;
        $this->shippingCost = $shippingCost;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->user = $user;
        $this->country = $country;
        $this->address = $address;
        $this->city = $city;
        $this->floor = $floor;
        $this->number = $number;
        $this->zipCode = $zipCode;
        $this->phone = $phone;
        $this->payment = $payment;
        $this->orderLines = new ArrayCollection();
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTotalBase(): ?int
    {
        return $this->totalBase;
    }

    public function setTotalBase(int $totalBase): self
    {
        $this->totalBase = $totalBase;

        return $this;
    }

    public function getShippingCost(): ?int
    {
        return $this->shippingCost;
    }

    public function setShippingCost(int $shippingCost): self
    {
        $this->shippingCost = $shippingCost;

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return Collection<int, OrderLines>
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLines $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setOrderEntity($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLines $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getOrderEntity() === $this) {
                $orderLine->setOrderEntity(null);
            }
        }

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
