<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228144406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacto_donante (id INT AUTO_INCREMENT NOT NULL, direccion VARCHAR(100) NOT NULL, codigo_postal VARCHAR(5) NOT NULL, ciudad VARCHAR(20) NOT NULL, pais VARCHAR(50) NOT NULL, telefono VARCHAR(9) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donaciones_proyectos (donaciones_id INT NOT NULL, proyectos_id INT NOT NULL, INDEX IDX_96E8BCC7F36D68F9 (donaciones_id), INDEX IDX_96E8BCC7CC33C266 (proyectos_id), PRIMARY KEY(donaciones_id, proyectos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donaciones_proyectos ADD CONSTRAINT FK_96E8BCC7F36D68F9 FOREIGN KEY (donaciones_id) REFERENCES donaciones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE donaciones_proyectos ADD CONSTRAINT FK_96E8BCC7CC33C266 FOREIGN KEY (proyectos_id) REFERENCES proyectos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE donaciones ADD donante_id INT NOT NULL');
        $this->addSql('ALTER TABLE donaciones ADD CONSTRAINT FK_BA34A102FBA844E7 FOREIGN KEY (donante_id) REFERENCES donante (id)');
        $this->addSql('CREATE INDEX IDX_BA34A102FBA844E7 ON donaciones (donante_id)');
        $this->addSql('ALTER TABLE donante ADD contacto_id INT NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE donante ADD CONSTRAINT FK_8A6D9C426B505CA9 FOREIGN KEY (contacto_id) REFERENCES contacto (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A6D9C426B505CA9 ON donante (contacto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE donante DROP FOREIGN KEY FK_8A6D9C426B505CA9');
        $this->addSql('ALTER TABLE donaciones_proyectos DROP FOREIGN KEY FK_96E8BCC7F36D68F9');
        $this->addSql('ALTER TABLE donaciones_proyectos DROP FOREIGN KEY FK_96E8BCC7CC33C266');
        $this->addSql('DROP TABLE contacto');
        $this->addSql('DROP TABLE donaciones_proyectos');
        $this->addSql('ALTER TABLE donaciones DROP FOREIGN KEY FK_BA34A102FBA844E7');
        $this->addSql('DROP INDEX IDX_BA34A102FBA844E7 ON donaciones');
        $this->addSql('ALTER TABLE donaciones DROP donante_id');
        $this->addSql('DROP INDEX UNIQ_8A6D9C426B505CA9 ON donante');
        $this->addSql('ALTER TABLE donante DROP contacto_id, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
