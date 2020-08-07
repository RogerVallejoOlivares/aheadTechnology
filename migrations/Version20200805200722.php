<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805200722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create tables and relationship';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellidos VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE datos_bancarios (cliente_id INT NOT NULL, iban VARCHAR(255) NOT NULL, direccion_facturacion VARCHAR(255) DEFAULT NULL, dni VARCHAR(10) DEFAULT NULL, PRIMARY KEY(cliente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE datos_bancarios ADD CONSTRAINT FK_33219384DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE datos_bancarios DROP FOREIGN KEY FK_33219384DE734E51');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE datos_bancarios');
    }
}
