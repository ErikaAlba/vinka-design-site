<?php

namespace App\EntryPoint\Controller\Admin\Product;

use App\Domain\Model\Product\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Uid\Uuid;

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
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
