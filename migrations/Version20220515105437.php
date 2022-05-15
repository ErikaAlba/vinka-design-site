<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515105437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', total INT NOT NULL, total_base INT NOT NULL, shipping_cost INT NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, floor VARCHAR(255) DEFAULT NULL, number VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, payment VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_lines (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', order_entity_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', quantity INT NOT NULL, name VARCHAR(255) NOT NULL, total_price INT NOT NULL, total_base_price INT NOT NULL, rate DOUBLE PRECISION NOT NULL, INDEX IDX_CC9FF86B4584665A (product_id), INDEX IDX_CC9FF86B3DA206A5 (order_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_lines ADD CONSTRAINT FK_CC9FF86B4584665A FOREIGN KEY (product_id) REFERENCES product (product_id)');
        $this->addSql('ALTER TABLE order_lines ADD CONSTRAINT FK_CC9FF86B3DA206A5 FOREIGN KEY (order_entity_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE cart CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE cart RENAME INDEX idx_ba388b79d86650f TO IDX_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart_line CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE cart_id cart_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE cart_line RENAME INDEX idx_3ef1b4cfde18e50b TO IDX_3EF1B4CF4584665A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_lines DROP FOREIGN KEY FK_CC9FF86B3DA206A5');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_lines');
        $this->addSql('ALTER TABLE cart CHANGE id id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE cart RENAME INDEX idx_ba388b7a76ed395 TO IDX_BA388B79D86650F');
        $this->addSql('ALTER TABLE cart_line CHANGE id id CHAR(36) NOT NULL, CHANGE cart_id cart_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE cart_line RENAME INDEX idx_3ef1b4cf4584665a TO IDX_3EF1B4CFDE18E50B');
    }
}
