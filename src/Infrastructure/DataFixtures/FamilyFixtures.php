<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Model\Family\Family;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FamilyFixtures extends Fixture
{
    public const FAMILY_HEADDRESSES = 'family-headdresses'; // tocados
    public const FAMILY_BOW_TIES = 'family-bow-ties'; // pajaritas
    public const FAMILY_HATS = 'family-hats'; // pamelas

    public function load(ObjectManager $manager)
    {
        $family1 = new Family();
        $family1->setFamilyId('497af14e-9c7f-443d-a467-8b142cc4a129');
        $family1->setName('Tocados');

        $family2 = new Family();
        $family2->setFamilyId('9cd5132a-767f-427a-b17f-dff3b75967e2');
        $family2->setName('Pajaritas');

        $family3 = new Family();
        $family3->setFamilyId('caf02773-b688-4d46-82f4-b3acf4c73481');
        $family3->setName('Pamelas');

        $this->addReference(self::FAMILY_HEADDRESSES, $family1);
        $this->addReference(self::FAMILY_BOW_TIES, $family2);
        $this->addReference(self::FAMILY_HATS, $family3);

        $manager->persist($family1);
        $manager->persist($family2);
        $manager->persist($family3);

        $manager->flush();
    }
}