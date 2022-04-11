<?php

namespace App\Domain\Model\Product;

use App\Domain\Model\Family\Family;
use App\Infrastructure\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[Vich\Uploadable]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private $productId;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference;

    #[ORM\Column(type: 'datetime')]
    private $createdDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $mainImage;

    #[Vich\UploadableField(mapping: "product_images",fileNameProperty: "mainImage")]
    private $imageFile;

    #[ORM\Column(type: "datetime")]
    private $updateAt;

    #[ORM\ManyToOne(targetEntity: Family::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'family_id')]
    private $family;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param mixed $updateAt
     */
    public function setUpdateAt($updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function createdDate(): \DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function family(): ?Family
    {
        return $this->family;
    }

    public function setFamily(Family $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function mainImage()
    {
        return $this->mainImage;
    }

    public function setMainImage($mainImage): void
    {
        $this->mainImage = $mainImage;
    }

}
