<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181103213754 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA62F68B530');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA69777D11E');
        $this->addSql('DROP INDEX IDX_2D3A8DA69777D11E ON expense');
        $this->addSql('DROP INDEX IDX_2D3A8DA62F68B530 ON expense');
        $this->addSql('ALTER TABLE expense ADD expense_group_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL, DROP category_id_id, DROP group_id_id');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA638351BBE FOREIGN KEY (expense_group_id) REFERENCES expense_group (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA638351BBE ON expense (expense_group_id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA612469DE2 ON expense (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA638351BBE');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA612469DE2');
        $this->addSql('DROP INDEX IDX_2D3A8DA638351BBE ON expense');
        $this->addSql('DROP INDEX IDX_2D3A8DA612469DE2 ON expense');
        $this->addSql('ALTER TABLE expense ADD category_id_id INT DEFAULT NULL, ADD group_id_id INT DEFAULT NULL, DROP expense_group_id, DROP category_id');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA62F68B530 FOREIGN KEY (group_id_id) REFERENCES expense_group (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA69777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA69777D11E ON expense (category_id_id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA62F68B530 ON expense (group_id_id)');
    }
}
