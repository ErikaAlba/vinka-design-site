<?php

namespace App\EntryPoint\Controller\Admin\Customers;

use App\Domain\Model\Customers\Customers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Uid\Uuid;

class CustomersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customers::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $customer = new Customers();
        $customer->setCustomerId(Uuid::v4()->jsonSerialize());

        return $customer;
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
