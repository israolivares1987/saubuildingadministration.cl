<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201231204657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datos_unidad CHANGE metros2 metros2 DOUBLE PRECISION DEFAULT NULL, CHANGE dormitorios dormitorios INT DEFAULT NULL, CHANGE banios banios INT DEFAULT NULL, CHANGE direccion direccion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad CHANGE empresa_id empresa_id INT DEFAULT NULL, CHANGE edificio edificio VARCHAR(10) DEFAULT NULL, CHANGE piso piso VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datos_unidad CHANGE metros2 metros2 DOUBLE PRECISION DEFAULT \'NULL\', CHANGE dormitorios dormitorios INT DEFAULT NULL, CHANGE banios banios INT DEFAULT NULL, CHANGE direccion direccion VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE unidad CHANGE empresa_id empresa_id INT DEFAULT NULL, CHANGE edificio edificio VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE piso piso VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
