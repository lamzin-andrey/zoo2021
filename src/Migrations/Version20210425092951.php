<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425092951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create indexes and relations in database tables. Fill AnimalTypes table.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
		$this->addSql('ALTER TABLE `cage_animals_relation`
			ADD index `animal_id` (`animal_id`),
			ADD index `animal_type_id` (`animal_type_id`),
			ADD index `cage_id` (`cage_id`),
			ADD CONSTRAINT animal_type_id  FOREIGN KEY (animal_type_id) 
				 REFERENCES animal_type(id)
		');
		
		$this->addSql('INSERT INTO animal_type (`entity_name`)
		VALUES (\'\\\\App\\\\Entity\\\\Crocodile\'),
			(\'\\\\App\\\\Entity\\\\Elephant\'),
			(\'\\\\App\\\\Entity\\\\Lion\')
		');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
