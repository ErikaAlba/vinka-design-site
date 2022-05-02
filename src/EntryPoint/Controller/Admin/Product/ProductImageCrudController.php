<?php declare(strict_types=1);

namespace App\EntryPoint\Controller\Admin\Product;

use App\Domain\Model\Product\ProductImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Uid\Uuid;

final class ProductImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductImage::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $product = new ProductImage();
        $product->setId(Uuid::v4()->jsonSerialize());
        $product->setUpdateAt(new \DateTime());

        return $product;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('product');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            AssociationField::new('product'),
            ImageField::new('image')
                ->setBasePath('images/products')
                ->setUploadDir('public/images/products')
                ->setUploadedFileNamePattern('[uuid].[extension]'),
        ];
    }
}