<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230819195608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anthology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, nft_id INT DEFAULT NULL, note LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_9474526CE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, is_public TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, date_creation DATETIME NOT NULL, INDEX IDX_472B783AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_favori (id INT AUTO_INCREMENT NOT NULL, nft_id INT DEFAULT NULL, type VARCHAR(10) NOT NULL, date_action DATETIME NOT NULL, INDEX IDX_D15CB13EE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nft (id INT AUTO_INCREMENT NOT NULL, sub_category_id INT DEFAULT NULL, anthology_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, creator VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_first_sale DATETIME DEFAULT NULL, date_last_sale DATETIME DEFAULT NULL, identification_key VARCHAR(255) DEFAULT NULL, path_nft VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, is_public TINYINT(1) NOT NULL, quantity INT DEFAULT NULL, view INT NOT NULL, INDEX IDX_D9C7463CF7BFE87C (sub_category_id), INDEX IDX_D9C7463CCAC32C08 (anthology_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_BCE3F79812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_man TINYINT(1) DEFAULT NULL, birth_day DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE like_favori ADD CONSTRAINT FK_D15CB13EE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463CF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463CCAC32C08 FOREIGN KEY (anthology_id) REFERENCES anthology (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE813668D');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AA76ED395');
        $this->addSql('ALTER TABLE like_favori DROP FOREIGN KEY FK_D15CB13EE813668D');
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463CF7BFE87C');
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463CCAC32C08');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('DROP TABLE anthology');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE like_favori');
        $this->addSql('DROP TABLE nft');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
