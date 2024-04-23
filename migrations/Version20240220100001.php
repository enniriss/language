<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220100001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arabe (id INT AUTO_INCREMENT NOT NULL, classe VARCHAR(255) NOT NULL, mot VARCHAR(255) NOT NULL, image LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arabe_francais (arabe_id INT NOT NULL, francais_id INT NOT NULL, INDEX IDX_AEC7E425B7365D8F (arabe_id), INDEX IDX_AEC7E425A27D13B7 (francais_id), PRIMARY KEY(arabe_id, francais_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arabe_francais ADD CONSTRAINT FK_AEC7E425B7365D8F FOREIGN KEY (arabe_id) REFERENCES arabe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arabe_francais ADD CONSTRAINT FK_AEC7E425A27D13B7 FOREIGN KEY (francais_id) REFERENCES francais (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arabe_francais DROP FOREIGN KEY FK_AEC7E425B7365D8F');
        $this->addSql('ALTER TABLE arabe_francais DROP FOREIGN KEY FK_AEC7E425A27D13B7');
        $this->addSql('DROP TABLE arabe');
        $this->addSql('DROP TABLE arabe_francais');
    }
}
