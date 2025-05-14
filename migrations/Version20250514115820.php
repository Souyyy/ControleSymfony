<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514115820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etapes (id INT AUTO_INCREMENT NOT NULL, descriptif VARCHAR(255) NOT NULL, consignes LONGTEXT NOT NULL, position_dans_le_parcours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, repond_a_id INT DEFAULT NULL, emet_id INT DEFAULT NULL, recoit_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, datetime DATETIME NOT NULL, UNIQUE INDEX UNIQ_DB021E96EB5A4A82 (repond_a_id), INDEX IDX_DB021E96DC07736C (emet_id), INDEX IDX_DB021E96AD48400 (recoit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messages_rendus_activites (messages_id INT NOT NULL, rendus_activites_id INT NOT NULL, INDEX IDX_69D7EFF1A5905F5A (messages_id), INDEX IDX_69D7EFF1A7844EA2 (rendus_activites_id), PRIMARY KEY(messages_id, rendus_activites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, propose_id INT DEFAULT NULL, accepte_id INT DEFAULT NULL, date_heure DATETIME NOT NULL, effectuer TINYINT(1) NOT NULL, modalite VARCHAR(255) NOT NULL, INDEX IDX_65E8AA0AFC1D5802 (propose_id), INDEX IDX_65E8AA0AAD232E9E (accepte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendus_activites (id INT AUTO_INCREMENT NOT NULL, depose_id INT DEFAULT NULL, url_du_document_plysique LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_4F9C19EE41CD8671 (depose_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendus_activites_etapes (rendus_activites_id INT NOT NULL, etapes_id INT NOT NULL, INDEX IDX_BAB0D5F7A7844EA2 (rendus_activites_id), INDEX IDX_BAB0D5F74F5CEED2 (etapes_id), PRIMARY KEY(rendus_activites_id, etapes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, presente_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, url_du_document_physique VARCHAR(255) NOT NULL, support LONGTEXT NOT NULL COMMENT '(DC2Type:array)', nature LONGTEXT NOT NULL COMMENT '(DC2Type:array)', INDEX IDX_6A2CD5C721E8B456 (presente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages ADD CONSTRAINT FK_DB021E96EB5A4A82 FOREIGN KEY (repond_a_id) REFERENCES messages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages ADD CONSTRAINT FK_DB021E96DC07736C FOREIGN KEY (emet_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages ADD CONSTRAINT FK_DB021E96AD48400 FOREIGN KEY (recoit_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites ADD CONSTRAINT FK_69D7EFF1A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites ADD CONSTRAINT FK_69D7EFF1A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AFC1D5802 FOREIGN KEY (propose_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AAD232E9E FOREIGN KEY (accepte_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites ADD CONSTRAINT FK_4F9C19EE41CD8671 FOREIGN KEY (depose_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes ADD CONSTRAINT FK_BAB0D5F7A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes ADD CONSTRAINT FK_BAB0D5F74F5CEED2 FOREIGN KEY (etapes_id) REFERENCES etapes (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C721E8B456 FOREIGN KEY (presente_id) REFERENCES etapes (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD accompagne_id INT DEFAULT NULL, ADD choisit_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649E0B1098A FOREIGN KEY (accompagne_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DCD0E22 FOREIGN KEY (choisit_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649E0B1098A ON user (accompagne_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D6494DCD0E22 ON user (choisit_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DCD0E22
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96EB5A4A82
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96DC07736C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96AD48400
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites DROP FOREIGN KEY FK_69D7EFF1A5905F5A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites DROP FOREIGN KEY FK_69D7EFF1A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AFC1D5802
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AAD232E9E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites DROP FOREIGN KEY FK_4F9C19EE41CD8671
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes DROP FOREIGN KEY FK_BAB0D5F7A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes DROP FOREIGN KEY FK_BAB0D5F74F5CEED2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C721E8B456
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etapes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messages
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messages_rendus_activites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parcours
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendez_vous
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendus_activites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendus_activites_etapes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressources
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E0B1098A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649E0B1098A ON user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D6494DCD0E22 ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP accompagne_id, DROP choisit_id
        SQL);
    }
}
