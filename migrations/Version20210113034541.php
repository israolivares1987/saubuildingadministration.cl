<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113034541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrendatario CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente CHANGE rut rut VARCHAR(255) DEFAULT NULL, CHANGE nombres nombres VARCHAR(255) DEFAULT NULL, CHANGE apellidos apellidos VARCHAR(255) DEFAULT NULL, CHANGE domicilio domicilio VARCHAR(255) DEFAULT NULL, CHANGE telefono1 telefono1 VARCHAR(255) DEFAULT NULL, CHANGE telefono2 telefono2 VARCHAR(255) DEFAULT NULL, CHANGE celular celular VARCHAR(255) DEFAULT NULL, CHANGE email1 email1 VARCHAR(255) DEFAULT NULL, CHANGE email2 email2 VARCHAR(255) DEFAULT NULL, CHANGE representante representante VARCHAR(255) DEFAULT NULL, CHANGE relacion relacion VARCHAR(255) DEFAULT NULL, CHANGE razon_social razon_social VARCHAR(255) DEFAULT NULL, CHANGE fecha_inicio fecha_inicio DATETIME DEFAULT NULL, CHANGE rol rol VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE corredora CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE datos_unidad CHANGE metros2 metros2 DOUBLE PRECISION DEFAULT NULL, CHANGE dormitorios dormitorios INT DEFAULT NULL, CHANGE banios banios INT DEFAULT NULL, CHANGE direccion direccion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE propietario CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad CHANGE piso piso VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrendatario CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente CHANGE rut rut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nombres nombres VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE domicilio domicilio VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telefono1 telefono1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telefono2 telefono2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE celular celular VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email1 email1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email2 email2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE representante representante VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE relacion relacion VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE razon_social razon_social VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE fecha_inicio fecha_inicio DATETIME DEFAULT \'NULL\', CHANGE rol rol VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corredora CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE datos_unidad CHANGE metros2 metros2 DOUBLE PRECISION DEFAULT \'NULL\', CHANGE dormitorios dormitorios INT DEFAULT NULL, CHANGE banios banios INT DEFAULT NULL, CHANGE direccion direccion VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE propietario CHANGE cliente_id cliente_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad CHANGE piso piso VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
