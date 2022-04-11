<?php

namespace App\EntryPoint\Controller\Admin\Product;

use App\Domain\Model\Family\Family;
use App\Domain\Model\Product\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Uid\Uuid;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Config\Twig\DateConfig;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $product = new Product();
        $product->setProductId(Uuid::v4()->jsonSerialize());

        return $product;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('product_id')->setDisabled(),
            TextField::new('name'),
            TextEditorField::new('description'),
            TextField::new('reference'),
            DateField::new('created_date'),
            AssociationField::new('family'),
            ImageField::new('mainImage')
                ->setBasePath('images/uploads')
                ->setUploadDir('public/images')
        ];
    }

}
