<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250922191240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, nb_players_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, duration SMALLINT DEFAULT NULL, last_date_played DATE DEFAULT NULL, note SMALLINT DEFAULT NULL, INDEX IDX_232B318CC640B7FA (nb_players_id), INDEX IDX_232B318C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nb_player (id INT AUTO_INCREMENT NOT NULL, nb_players SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CC640B7FA FOREIGN KEY (nb_players_id) REFERENCES nb_player (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CC640B7FA');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE nb_player');
    }
}
