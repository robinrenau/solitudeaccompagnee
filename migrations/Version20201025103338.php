<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025103338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, user_id INT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, eventdate DATETIME NOT NULL, created_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, max_participants INT NOT NULL, UNIQUE INDEX UNIQ_AC74095A989D9B62 (slug), INDEX IDX_AC74095A8BAC62AF (city_id), INDEX IDX_AC74095AA76ED395 (user_id), INDEX IDX_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_participation (id INT AUTO_INCREMENT NOT NULL, activity_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_AA872B8B81C06096 (activity_id), INDEX IDX_AA872B8BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, slug VARCHAR(255) NOT NULL, lng DOUBLE PRECISION NOT NULL, label VARCHAR(255) NOT NULL, headerphoto VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D5B0234989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activity_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C81C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, dateofbirth DATE NOT NULL, profil_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE activity_participation ADD CONSTRAINT FK_AA872B8B81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE activity_participation ADD CONSTRAINT FK_AA872B8BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_participation DROP FOREIGN KEY FK_AA872B8B81C06096');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C81C06096');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A8BAC62AF');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AA76ED395');
        $this->addSql('ALTER TABLE activity_participation DROP FOREIGN KEY FK_AA872B8BA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_participation');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
