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

//    private function __construct(string $familyId, string $name)
//    {
//        $this->familyId = $familyId;
//        $this->name = $name;
//    }


    public function familyId(): string
    {
        return $this->familyId;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $familyId
     */
    public function setFamilyId(string $familyId): void
    {
        $this->familyId = $familyId;
    }


    public function __toString(): string
    {
        return $this->name();
    }

}
