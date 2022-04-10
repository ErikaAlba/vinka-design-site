<?php

namespace App\Domain\Model\Family;

use App\Infrastructure\Repository\Family\FamilyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private string $familyId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function __construct(string $familyId, string $name)
    {
        $this->familyId = $familyId;
        $this->name = $name;
    }


    public function familyId(): string
    {
        return $this->familyId;
    }

    public function name(): string
    {
        return $this->name;
    }
}
