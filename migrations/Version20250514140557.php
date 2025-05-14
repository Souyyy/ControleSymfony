<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514140557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE tapes (id INT AUTO_INCREMENT NOT NULL, est_compose_id INT DEFAULT NULL, INDEX IDX_CC9DF640DE55B364 (est_compose_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tapes ADD CONSTRAINT FK_CC9DF640DE55B364 FOREIGN KEY (est_compose_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes ADD parcours_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes ADD CONSTRAINT FK_E3443E176E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3443E176E38C0DB ON etapes (parcours_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE tapes DROP FOREIGN KEY FK_CC9DF640DE55B364
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tapes
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes DROP FOREIGN KEY FK_E3443E176E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3443E176E38C0DB ON etapes
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes DROP parcours_id
        SQL);
    }
}
