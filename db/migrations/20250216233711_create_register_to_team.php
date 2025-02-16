<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRegisterToTeam extends AbstractMigration
{
    public function change(): void
    {
        $query = <<<SQL
INSERT INTO team (uuid, name, city, created_at) VALUES
('1ffbc9a5-f8e8-4d49-9906-df366429d95b', 'Barcelona', 'Barcelona', NOW()),
('5a8a875c-d7fd-4ab9-b6c2-9d4d36b2d67d', 'Real Madrid', 'Madrid', NOW()),
('7bb65eaa-b2eb-45ee-bde9-c0578fce0448', 'Team Test', 'Barcelona', NOW());
SQL;

        $this->execute($query);
    }

    public function down(): void
    {
        $this->execute('TRUNCATE TABLE player');
        $this->execute('TRUNCATE TABLE team');
    }
}
