<?php

namespace App\Domain\Model\Product;

use App\Infrastructure\Repository\Product\ProductImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProductImageRepository::class)]
#[Vich\Uploadable]
class ProductImage
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productImages')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'product_id')]
    private $product;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[Vich\UploadableField(mapping: "product_images",fileNameProperty: "image")]
    private $imageFile;

    #[ORM\Column(type: "datetime")]
    private $updateAt;

    public function setImage(string $image = null)
    {
        $this->image = $image;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
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

    public function setUpdateAt(\DateTime $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    public function image()
    {
        return $this->image;
    }

    public function updateAt()
    {
        return $this->updateAt;
    }

    public function __toString(): string
    {
        return $this->image;
    }
}
