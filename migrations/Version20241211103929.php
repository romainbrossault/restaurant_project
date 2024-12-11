<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211103929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_items RENAME INDEX idx_menu_id TO IDX_70B2CA2ACCD7E912');
        $this->addSql('ALTER TABLE menu_items RENAME INDEX idx_item_id TO IDX_70B2CA2A126F525E');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2ACCD7E912');
        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2A126F525E');
        $this->addSql('ALTER TABLE menu_items RENAME INDEX idx_70b2ca2accd7e912 TO IDX_MENU_ID');
        $this->addSql('ALTER TABLE menu_items RENAME INDEX idx_70b2ca2a126f525e TO IDX_ITEM_ID');
    }
}
