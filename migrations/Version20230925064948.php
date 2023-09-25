<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925064948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_list (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, product_id INT DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, INDEX IDX_2CBDB670A76ED395 (user_id), UNIQUE INDEX UNIQ_2CBDB6704584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, discount_percent NUMERIC(8, 2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, price_discount NUMERIC(8, 2) NOT NULL, price_total NUMERIC(8, 2) NOT NULL, address_holder VARCHAR(255) NOT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, e_mail VARCHAR(255) NOT NULL, INDEX IDX_845CA2C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_items (id INT AUTO_INCREMENT NOT NULL, order_details_id INT DEFAULT NULL, product_id INT DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, price_taxed NUMERIC(8, 2) NOT NULL, quantity INT NOT NULL, price_total NUMERIC(8, 2) NOT NULL, INDEX IDX_62809DB08C0FA77 (order_details_id), INDEX IDX_62809DB04584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_list_items (id INT AUTO_INCREMENT NOT NULL, price_list_id INT DEFAULT NULL, product_id INT DEFAULT NULL, price NUMERIC(8, 2) NOT NULL, INDEX IDX_8C05724A5688DED7 (price_list_id), INDEX IDX_8C05724A4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(8, 2) NOT NULL, sku VARCHAR(255) NOT NULL, published TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D34A04ADF9038C4 (sku), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tax (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tax_percent NUMERIC(8, 2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, e_mail VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, address_holder VARCHAR(255) NOT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, INDEX IDX_5543718BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE contract_list ADD CONSTRAINT FK_2CBDB670A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contract_list ADD CONSTRAINT FK_2CBDB6704584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB08C0FA77 FOREIGN KEY (order_details_id) REFERENCES order_details (id)');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE price_list_items ADD CONSTRAINT FK_8C05724A5688DED7 FOREIGN KEY (price_list_id) REFERENCES price_list (id)');
        $this->addSql('ALTER TABLE price_list_items ADD CONSTRAINT FK_8C05724A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE contract_list DROP FOREIGN KEY FK_2CBDB670A76ED395');
        $this->addSql('ALTER TABLE contract_list DROP FOREIGN KEY FK_2CBDB6704584665A');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1A76ED395');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB08C0FA77');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB04584665A');
        $this->addSql('ALTER TABLE price_list_items DROP FOREIGN KEY FK_8C05724A5688DED7');
        $this->addSql('ALTER TABLE price_list_items DROP FOREIGN KEY FK_8C05724A4584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BA76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE contract_list');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('DROP TABLE price_list');
        $this->addSql('DROP TABLE price_list_items');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE tax');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_address');
    }
}
