<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200807080638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Insert default values';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO cliente (nombre, apellidos, email, telefono) VALUES
	('Roger','Vallejo', 'roger@mail.com', '000000001'),
    ('Erik','Asis', 'erik@mail.com', '000000002'),
    ('Mireia','Garcia', 'mireia@mail.com', '000000003'),
    ('Marc','Prior', 'marc@mail.com', '000000004'),
    ('Marta','Quijada', 'marta@mail.com', '000000005'),
    ('Ana','Garcia', 'ana@mail.com', '000000006'),
    ('paco','rodriguez', 'paco@mail.com', '000000007'),
    ('antonio','Garcia', 'antonio@mail.com', '000000008'),
    ('tony','Carpio', 'tony@mail.com', '000000009'),
    ('Nerea','Fajardo', 'nerea@mail.com', '000000010'),
    ('Adri','Fajardo', 'adri@mail.com', '000000011'),
    ('Ester','Ortiz', 'ester@mail.com', '000000012'),
    ('Izan','Perez', 'izan@mail.com', '000000013'),
    ('Miriam','hernandez', 'miriam@mail.com', '000000014'),
    ('Eva','Vallejo', 'evi@mail.com', '000000015'),
    ('Neus','Vallejo', 'neus@mail.com', '000000016'),
    ('Paquita','Olivares', 'paquita@mail.com', '000000017'),
    ('Laura','Gallego', 'laura@mail.com', '000000018'),
    ('John','Tolkien', 'john@mail.com', '000000019'),
    ('Jenny','Rowling', 'Jenny@mail.com', '000000020'),
    ('Felipe','Vallejo', 'felipe@mail.com', '000000021'),
    ('Maria','Garcia', 'maria@mail.com', '000000022'),
    ('Edgar','Allan', 'edgar@mail.com', '000000023'),
    ('William','Shakespare', 'william@mail.com', '000000024'),
    ('Oscar','Wilde', 'oscar@mail.com', '000000025'),
    ('Fran','Kafka', 'fran@mail.com', '000000026'),
    ('James','Joyce', 'james@mail.com', '000000027'),
    ('Patrick','rothfus', 'patrick@mail.com', '000000028'),
    ('Gabriel','Marquez', 'Gabriel@mail.com', '000000029'),
    ('Paulo','Coelho', 'paulo@mail.com', '000000030'),
    ('george','Orwell', 'george@mail.com', '000000031'),
    ('Orson','wells', 'orson@mail.com', '000000032'),
    ('Isaac','Asimov', 'isaac@mail.com', '000000033'),
    ('Charles','Dickens', 'charles@mail.com', '000000034');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM datos_bancarios WHERE cliente_id > 1;");
        $this->addSql("DELETE FROM cliente WHERE id > 1;");

    }
}
