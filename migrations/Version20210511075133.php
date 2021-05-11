<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511075133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE contributor');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE validate_user');
        $this->addSql('DROP TABLE video');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, trick_id_id INT NOT NULL, user_id_id INT NOT NULL, created_at DATETIME NOT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_9474526C9D86650F (user_id_id), INDEX IDX_9474526CB46B9EE8 (trick_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contributor (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, trick_id_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA6F9793B46B9EE8 (trick_id_id), INDEX IDX_DA6F97939D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, trick_id_id INT NOT NULL, user_id_id INT DEFAULT NULL, image LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C53D045F9D86650F (user_id_id), INDEX IDX_C53D045FB46B9EE8 (trick_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE validate_user (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, INDEX IDX_9AEAA5EA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, trick_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, embed LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7CC7DA2C9D86650F (user_id_id), INDEX IDX_7CC7DA2CB46B9EE8 (trick_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F97939D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F9793B46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE validate_user ADD CONSTRAINT FK_9AEAA5EA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB46B9EE8 FOREIGN KEY (trick_id_id) REFERENCES trick (id)');
    }
}
