<?php

namespace App\EntryPoint\Controller\Admin\Family;

use App\Domain\Model\Family\Family;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Uid\Uuid;

class FamilyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Family::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $family = new Family();
        $family->setFamilyId(Uuid::v4()->jsonSerialize());

        return $family;
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
