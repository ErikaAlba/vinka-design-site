<?php

namespace App\Domain\Model\CartLines;

use App\Infrastructure\Repository\CartLines\CartLinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartLinesRepository::class)]
class CartLines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
