<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Model\Product\Product;
use App\Domain\Model\Product\ProductImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\Entity\File;

class ProductFixtures extends Fixture
{
    private const IMAGES = [
        '03e455b5-0d46-41cc-aace-396df5557608' => [
            'e77fb653-ebd9-4690-87b2-043bebeab4a5',
            '3bd7d6ab-9c25-45be-a944-f73f0b9771ad',
            '934a6fff-a0cd-4a3b-8fcc-afb278cbaa51',
        ],
        '0f459b2b-f16e-4f7f-bfbb-b85eea997fa2' => [
            'e2034987-c4ea-47c9-b6e4-3adb818f0211',
            'd54339f3-857d-4aeb-bc67-ba5c6c22d632',
            '35387632-ef60-4d56-9b88-4d3040275fcf',
            'a32a0383-b99c-468e-a88d-98df60346d39',
            'e0095e70-204b-4897-a344-2d5067b3a84c',
        ],
        '160975ea-a5b0-442f-949a-0378bd394549' => [
            'c545364c-aa5f-4e8e-b89f-2477c2f4f6cf',
            'b515dfb2-88e5-4cde-8374-b1cd11fa9258',
            'b7b44e02-51ef-48f7-bb62-eaade5e18364',
            '5c9fe5a0-025a-4870-b7ab-46433e4909ce',
        ],
        '1b34cb21-a187-46b7-afbc-e3aee722dd0c' => [
            '44a0e4b3-47af-4d1a-ad11-1f6d05520eb7',
            '768ee490-d630-4820-a12c-d91615dc0b39',
            '6b606bc5-87c8-4b60-a186-f386cde9164d',
            '1b2e4e19-3866-4b30-8c18-c9d2d92bb85b',
            '15547827-ecd3-425b-b8ed-cd4d8c810b1e',
            '881f3f68-1ea8-40cb-a412-506c97a6a629',
        ],
        '1de7e998-a173-48e3-8b55-7c6e4ae99dd7' => [
            'b9f25d94-50dc-4342-8a0d-6e76dfa63b2d',
            '4ef25bd0-2237-4a03-9bca-214559b8edd6',
            '21c3d9d3-013f-4fde-b528-f59361b16aef',
        ],
        '33d62d76-5d2c-4f12-afbe-9af718cec839' => [
            'fa9fecec-efdd-4b25-8ed2-64a0366a11f3',
            'd6da4081-4dcb-407c-b351-ad7e4722cf45',
            '0b53169c-533e-46ae-abb8-3a6fcabee016',
            '02e26caf-8748-4681-ad9f-e279e2941dd8',
            '52a8b1c9-291c-497e-98e1-402f3f9f0b8a',
        ],
        '35dd6fe0-7f1d-4ecb-ad91-0b77ca952510' => [
            'dee87eb1-6213-41e9-a70e-4c3fa5904f49',
            'adb4875f-ed3b-47e7-865e-5ffeac5d85a8',
            '3c0967b0-170f-4755-9a70-809a5f7b0ee1',
            'd6962561-9910-4872-855c-e4c308f1992d',
            '050945d7-4c90-481b-a715-4a802e3b59c2',
        ],
        '3c341459-cbd1-4c6d-98b1-35cd99be80c2' => [
            '36469935-a248-4ac3-93dc-7e976bf00bae',
            '3d8d03a6-f4c8-4f63-b767-12c276ca631d',
            '72e63d26-7f39-4dc2-9eb3-1d59d9bab670',
            'aed7f8b6-715d-4573-b737-ae246a77d245',
        ],
        '66588ba7-76eb-4d10-ac0c-54ecc6412584' => [
            '59edf922-f494-4920-9c14-1ae9dbb62c87',
            '28915963-4ce9-4909-aae2-274e14109bc0',
            '193264f8-795a-4923-a6a9-4915b165a8b7',
            'afabbdb5-0031-4c1f-9a3f-c3cbeb2f58ad',
            '5b6abf6a-58e1-4699-a0a6-11b4c48dd025',
        ],
        '685669f2-89c0-4dc6-bb37-341e4eb96ae0' => [
            '0edf13ed-a109-4e0e-9ace-9cf98ed303c2',
            '8d6d98db-367b-4382-b9c3-2a0f4eeba92d',
            'cb39be5d-731c-419d-ac3a-743d323ffcf5',
            'e37a2e82-bdb2-4635-b996-b26a75c977a7',
            '03c93083-7e33-4e73-a95c-4db52653a5d1',
        ],
        '778e4047-640b-49d8-a7ce-11125f459a2e' => [
            'ea6e2a1c-63fe-4b84-b0f2-ce187bd61a36',
            '8439cbca-6ec2-4e8c-8946-4aba03ad9e95',
            '4a1d8564-bc23-42d3-baf3-46c04449a451',
            '363c310a-1e4c-4fd8-a259-07bff20cf892',
            'e74aa3f2-366b-49b3-8bb3-774c898530fb',
            'd9aab1b5-d1fb-430e-86d0-1a1f57315fca',
        ],
        '7baf4e5c-fc41-415a-ae16-181d151827b9' => [
            '169b11c8-509a-4b00-9f9e-e8204cadcf19',
            '4662b013-9450-449b-9bd2-59a225f62381',
            'ce4b83e2-34dc-4091-91f7-5aa92e83b4b8',
        ],
        '8e6c1001-26be-4398-acae-c9649dc2079a' => [
            '830f65a8-5e46-485d-a425-8f74d3ee4c25',
            '59ad0330-2c3b-4220-b29d-ab3389170f52',
            'ab1d1e2c-5038-4091-ab73-3ce1d350425d',
            'ae32d9fa-5f40-46c9-a807-38ac74160959',
        ],
        'a9475666-2668-4360-943a-b74ba892713c' => [
            '439455d7-0e1f-4182-80ee-e828b10f5d98',
            '2c8d3423-76fc-44e0-b6ad-cdac4c95c06a',
            '68400f75-7a5a-478c-aeab-920bf28b45a2',
            '306c4785-ff52-4469-81bc-808f0c53f5c1',
        ],
        'b227a7f4-1fa6-4858-a2db-df2b28f76d85' => [
            'ea2b1ba5-cf18-492b-b46a-96ad981c52b7',
            '2f888f0f-b224-4230-9864-7fb317cc9e11',
            'd1844b4b-3b05-4af7-a315-dce1fc46bf79',
            '2a159070-c84f-4549-8f51-8419f9d9fec2',
        ],
        'b67133b6-92b2-4b04-97aa-042aca3eca5c' => [
            'ded221f7-15f4-42dd-b6a7-6ab2fea80272',
            'ad8e6f21-fe96-4fc3-98c5-c9fa02b93656',
            '642a3825-786c-4370-8472-a03b0e794b9e',
            'c3c45007-751b-4cbc-b65e-9ba3f5dce8e6',
        ],
        'edd96e24-ca94-45e1-9047-ee5afd7f6398' => [
            '6e62295f-0840-43f2-8953-0a0373d8ae0e',
            '78764332-33a7-4134-b155-45498677b0b9',
            'e28bf02c-5373-49b8-aa1d-ebe14f308438',
        ],
    ];

    public function __construct(private string $projectDir)
    {
    }

    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('0f459b2b-f16e-4f7f-bfbb-b85eea997fa2');
        $product->setName('diadema tejida');
        $product->setPrice(3000);
        $product->setSlug('diadema-tejida');
        $product->setReference('00100');
        $product->setDescription('<div>diadema tejida en material reciclado con flores color beige y pluma</div>');
        $product->setImageFile($this->generateImage('da58a872-0fff-4eb8-90e5-aae484d213e4'));
        $product->setMainImage('da58a872-0fff-4eb8-90e5-aae484d213e4.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('1b34cb21-a187-46b7-afbc-e3aee722dd0c');
        $product->setName('sombrero olga');
        $product->setPrice(10000);
        $product->setSlug('sombrero-olga');
        $product->setReference('00501');
        $product->setDescription('<div>sombrero Olga color beige con flores fucsia y pluma</div>');
        $product->setImageFile($this->generateImage('2c1e7da7-f40a-4c2c-8207-60d3d0ff61de'));
        $product->setMainImage('2c1e7da7-f40a-4c2c-8207-60d3d0ff61de.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('33d62d76-5d2c-4f12-afbe-9af718cec839');
        $product->setName('casco sinamay azul');
        $product->setPrice(6000);
        $product->setSlug('casco-sinamay-azul');
        $product->setReference('00222');
        $product->setDescription('<div>casco sinamay azul grande de raso y plumas avestruz</div>');
        $product->setImageFile($this->generateImage('a7783287-4bf6-4d78-880c-93d56281804a'));
        $product->setMainImage('a7783287-4bf6-4d78-880c-93d56281804a.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('35dd6fe0-7f1d-4ecb-ad91-0b77ca952510');
        $product->setName('casco sinamay');
        $product->setPrice(7500);
        $product->setSlug('casco-sinamay');
        $product->setReference('00221');
        $product->setDescription('<div>casco sinamay verde jade, flores y detalles en color naranja y salmón</div>');
        $product->setImageFile($this->generateImage('4f3b7d9b-893f-44ab-a722-8e2947caf448'));
        $product->setMainImage('4f3b7d9b-893f-44ab-a722-8e2947caf448.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('66588ba7-76eb-4d10-ac0c-54ecc6412584');
        $product->setName('tocado verde');
        $product->setPrice(5000);
        $product->setSlug('tocado-verde');
        $product->setReference('00331');
        $product->setDescription('<div>tocado verde</div>');
        $product->setImageFile($this->generateImage('b12b23fc-549d-41c7-9e2a-1c5527c516c1'));
        $product->setMainImage('b12b23fc-549d-41c7-9e2a-1c5527c516c1.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('685669f2-89c0-4dc6-bb37-341e4eb96ae0');
        $product->setName('tocado buntal gris');
        $product->setPrice(8500);
        $product->setSlug('tocado-buntal-gris');
        $product->setReference('0081');
        $product->setDescription('<div>tocado buntal gris con flores rojas, plumas y cinta</div>');
        $product->setImageFile($this->generateImage('b9c3a748-95aa-44b1-b895-8e0d896de211'));
        $product->setMainImage('b9c3a748-95aa-44b1-b895-8e0d896de211.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('778e4047-640b-49d8-a7ce-11125f459a2e');
        $product->setName('tocado azul');
        $product->setPrice(9000);
        $product->setSlug('tocado-azul');
        $product->setReference('0080');
        $product->setDescription('<div>Tocado buntal azul con flores y redecilla</div>');
        $product->setImageFile($this->generateImage('cad9bd47-bad2-4e2b-97f6-4b3cf1814605'));
        $product->setMainImage('cad9bd47-bad2-4e2b-97f6-4b3cf1814605.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HEADDRESSES));
        $product->setProductId('b227a7f4-1fa6-4858-a2db-df2b28f76d85');
        $product->setName('lágrima grande');
        $product->setPrice(6000);
        $product->setSlug('lágrima-grande');
        $product->setReference('00500');
        $product->setDescription('<div>lágrima grande color melón con detalle de flores y tul naranja</div>');
        $product->setImageFile($this->generateImage('35e2ab39-6740-469c-abd0-0ac994089766'));
        $product->setMainImage('35e2ab39-6740-469c-abd0-0ac994089766.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HATS));
        $product->setProductId('03e455b5-0d46-41cc-aace-396df5557608');
        $product->setName('pamela rosa');
        $product->setPrice(20000);
        $product->setSlug('pamela-rosa');
        $product->setReference('003');
        $product->setDescription('<div>pamela rosa</div>');
        $product->setImageFile($this->generateImage('36cc875a-60af-4b4e-bf5f-53319a532851'));
        $product->setMainImage('36cc875a-60af-4b4e-bf5f-53319a532851.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HATS));
        $product->setProductId('1de7e998-a173-48e3-8b55-7c6e4ae99dd7');
        $product->setName('pamela vanessa');
        $product->setPrice(15000);
        $product->setSlug('pamela-vanessa');
        $product->setReference('0032');
        $product->setDescription('<div>Pamela Vanessa color rosa palo con hojas de naranjo y flores blancas</div>');
        $product->setImageFile($this->generateImage('f1892778-989e-406f-a2e2-a416b6d5c5c8'));
        $product->setMainImage('f1892778-989e-406f-a2e2-a416b6d5c5c8.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HATS));
        $product->setProductId('7baf4e5c-fc41-415a-ae16-181d151827b9');
        $product->setName('pamela negra');
        $product->setPrice(16000);
        $product->setSlug('pamela-negra');
        $product->setReference('002');
        $product->setDescription('<div>pamela negra</div>');
        $product->setImageFile($this->generateImage('63c45d53-da50-4c50-8961-0685792ab372'));
        $product->setMainImage('63c45d53-da50-4c50-8961-0685792ab372.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_HATS));
        $product->setProductId('edd96e24-ca94-45e1-9047-ee5afd7f6398');
        $product->setName('pamela verde');
        $product->setPrice(13000);
        $product->setSlug('pamela-verde');
        $product->setReference('0001');
        $product->setDescription('<div>pamela verde</div>');
        $product->setImageFile($this->generateImage('f3658904-fb37-4b24-9afe-3c174fa0a0a9'));
        $product->setMainImage('f3658904-fb37-4b24-9afe-3c174fa0a0a9.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_BOW_TIES));
        $product->setProductId('160975ea-a5b0-442f-949a-0378bd394549');
        $product->setName('pajarita boda');
        $product->setPrice(1500);
        $product->setSlug('pajarita-boda');
        $product->setReference('00852');
        $product->setDescription('<div>pajarita para boda</div>');
        $product->setImageFile($this->generateImage('716a68d2-cbbd-4223-8657-1211632fed0f'));
        $product->setMainImage('716a68d2-cbbd-4223-8657-1211632fed0f.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_BOW_TIES));
        $product->setProductId('3c341459-cbd1-4c6d-98b1-35cd99be80c2');
        $product->setName('pajarita azul');
        $product->setPrice(1500);
        $product->setSlug('pajarita-azul');
        $product->setReference('002');
        $product->setDescription('<div>parajarita azul con puntos blancos</div>');
        $product->setImageFile($this->generateImage('250bfeaf-acc3-434b-a68e-c0b6cce4373d'));
        $product->setMainImage('250bfeaf-acc3-434b-a68e-c0b6cce4373d.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_BOW_TIES));
        $product->setProductId('8e6c1001-26be-4398-acae-c9649dc2079a');
        $product->setName('pajarita de algodón');
        $product->setPrice(1500);
        $product->setSlug('pajarita-algodón');
        $product->setReference('004');
        $product->setDescription('<div>pajarita de algodón</div>');
        $product->setImageFile($this->generateImage('ba76a5e2-0e9f-41fb-b43b-17121eb9a13d'));
        $product->setMainImage('ba76a5e2-0e9f-41fb-b43b-17121eb9a13d.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_BOW_TIES));
        $product->setProductId('a9475666-2668-4360-943a-b74ba892713c');
        $product->setName('pajarita bicolor');
        $product->setPrice(1500);
        $product->setSlug('pajarita-bicolor');
        $product->setReference('017');
        $product->setDescription('<div>pajarita bicolor</div>');
        $product->setImageFile($this->generateImage('3f95322c-ed74-4044-903a-3dd9d40a15fe'));
        $product->setMainImage('3f95322c-ed74-4044-903a-3dd9d40a15fe.jpg');
        $this->setProductImages($product);
        $manager->persist($product);

        $product = new Product();
        $product->setFamily($this->getReference(FamilyFixtures::FAMILY_BOW_TIES));
        $product->setProductId('b67133b6-92b2-4b04-97aa-042aca3eca5c');
        $product->setName('pajarita de seda');
        $product->setPrice(1500);
        $product->setSlug('pajarita-seda');
        $product->setReference('019');
        $product->setDescription('<div>pajarita de seda de diferentes colores&nbsp;</div>');
        $product->setImageFile($this->generateImage('2d2bd069-42ff-4002-a66a-f55cbf23d752'));
        $product->setMainImage('2d2bd069-42ff-4002-a66a-f55cbf23d752.jpg');
        $this->setProductImages($product);
        $manager->persist($product);


        $manager->flush();
    }

    private function setProductImages(Product $product)
    {
        $product->setCreatedDate(new \DateTime());
        $product->setUpdateAt(new \DateTime());
        foreach (self::IMAGES[$product->productId()] as $imageString) {
            $productImage = new ProductImage();
            $productImage->setImage($this->generateImage($imageString)->getOriginalName());
            $productImage->setUpdateAt(new \DateTime());
            $productImage->setId(Uuid::v4()->jsonSerialize());

            $product->addProductImage($productImage);
        }
    }

    private function generateImage(string $id): File
    {
        $file = new File();
        $file->setName($id);
        $file->setOriginalName($id . '.jpg');

        $filesystem = new Filesystem();
        $filesystem->copy(
            \realpath(\sprintf('%s/images/%s.jpg', __DIR__, $id)),
            \sprintf('%s/public/images/products/%s.jpg', $this->projectDir, $id),
            true
        );

        return $file;
    }
}