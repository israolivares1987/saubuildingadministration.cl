<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113042420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comunidad (id INT AUTO_INCREMENT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(255) NOT NULL, estado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conjunto (id INT AUTO_INCREMENT NOT NULL, tipo_conjunto_id INT DEFAULT NULL, comunidad_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, estado TINYINT(1) NOT NULL, INDEX IDX_2F323344184AFA4B (tipo_conjunto_id), INDEX IDX_2F323344B824C74B (comunidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_conjunto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conjunto ADD CONSTRAINT FK_2F323344184AFA4B FOREIGN KEY (tipo_conjunto_id) REFERENCES tipo_conjunto (id)');
        $this->addSql('ALTER TABLE conjunto ADD CONSTRAINT FK_2F323344B824C74B FOREIGN KEY (comunidad_id) REFERENCES comunidad (id)');
        $this->addSql('ALTER TABLE unidad ADD conjunto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad ADD CONSTRAINT FK_F3E6D02F2D6ED4B3 FOREIGN KEY (conjunto_id) REFERENCES conjunto (id)');
        $this->addSql('CREATE INDEX IDX_F3E6D02F2D6ED4B3 ON unidad (conjunto_id)');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE usuario_rol ADD comunidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario_rol ADD CONSTRAINT FK_72EDD1A4B824C74B FOREIGN KEY (comunidad_id) REFERENCES comunidad (id)');
        $this->addSql('CREATE INDEX IDX_72EDD1A4B824C74B ON usuario_rol (comunidad_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conjunto DROP FOREIGN KEY FK_2F323344B824C74B');
        $this->addSql('ALTER TABLE usuario_rol DROP FOREIGN KEY FK_72EDD1A4B824C74B');
        $this->addSql('ALTER TABLE unidad DROP FOREIGN KEY FK_F3E6D02F2D6ED4B3');
        $this->addSql('ALTER TABLE conjunto DROP FOREIGN KEY FK_2F323344184AFA4B');
        $this->addSql('DROP TABLE comunidad');
        $this->addSql('DROP TABLE conjunto');
        $this->addSql('DROP TABLE tipo_conjunto');
        $this->addSql('DROP INDEX IDX_F3E6D02F2D6ED4B3 ON unidad');
        $this->addSql('ALTER TABLE unidad DROP conjunto_id');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('DROP INDEX IDX_72EDD1A4B824C74B ON usuario_rol');
        $this->addSql('ALTER TABLE usuario_rol DROP comunidad_id');
    }
}
