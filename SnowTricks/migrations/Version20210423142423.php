<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423142423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE comment ADD trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_9474526CB281BE2E ON comment (trick_id)');
        $this->addSql('ALTER TABLE image ADD trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FB281BE2E ON image (trick_id)');
        $this->addSql('ALTER TABLE trick ADD trick_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E9B875DF8 FOREIGN KEY (trick_group_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E9B875DF8 ON trick (trick_group_id)');
        $this->addSql('ALTER TABLE video ADD trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CB281BE2E ON video (trick_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E');
        $this->addSql('DROP INDEX IDX_9474526CB281BE2E ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB281BE2E');
        $this->addSql('DROP INDEX IDX_C53D045FB281BE2E ON image');
        $this->addSql('ALTER TABLE image DROP trick_id');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E9B875DF8');
        $this->addSql('DROP INDEX IDX_D8F0A91E9B875DF8 ON trick');
        $this->addSql('ALTER TABLE trick DROP trick_group_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB281BE2E');
        $this->addSql('DROP INDEX IDX_7CC7DA2CB281BE2E ON video');
        $this->addSql('ALTER TABLE video DROP trick_id');
    }
}
