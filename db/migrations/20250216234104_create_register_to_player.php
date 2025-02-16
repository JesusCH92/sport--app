<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRegisterToPlayer extends AbstractMigration
{
    public function change(): void
    {
        $query = <<<SQL
INSERT INTO player (uuid, name, number, team_uuid, is_captain) VALUES
-- Jugadores para Barcelona
(UUID(), 'Player 1 Barcelona', 10, '1ffbc9a5-f8e8-4d49-9906-df366429d95b', 1),
(UUID(), 'Player 2 Barcelona', 7, '1ffbc9a5-f8e8-4d49-9906-df366429d95b', 0),
(UUID(), 'Player 3 Barcelona', 5, '1ffbc9a5-f8e8-4d49-9906-df366429d95b', 0),

-- Jugadores para Real Madrid
(UUID(), 'Player 1 Real Madrid', 9, '5a8a875c-d7fd-4ab9-b6c2-9d4d36b2d67d', 1),
(UUID(), 'Player 2 Real Madrid', 11, '5a8a875c-d7fd-4ab9-b6c2-9d4d36b2d67d', 0),
(UUID(), 'Player 3 Real Madrid', 4, '5a8a875c-d7fd-4ab9-b6c2-9d4d36b2d67d', 0),

-- Jugadores para Team Test
(UUID(), 'Player 1 Test', 8, '7bb65eaa-b2eb-45ee-bde9-c0578fce0448', 1),
(UUID(), 'Player 2 Test', 6, '7bb65eaa-b2eb-45ee-bde9-c0578fce0448', 0),
(UUID(), 'Player 3 Test', 3, '7bb65eaa-b2eb-45ee-bde9-c0578fce0448', 0);
SQL;

        $this->execute($query);
    }

    public function down(): void
    {
        $this->execute('TRUNCATE TABLE player');
    }
}
