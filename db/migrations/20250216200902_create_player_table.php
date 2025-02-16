<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePlayerTable extends AbstractMigration
{
    public function change(): void
    {
        $query = <<<SQL
CREATE TABLE player (
    uuid CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    number INT UNSIGNED NOT NULL,
    team_uuid CHAR(36) NOT NULL,
    is_captain BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (team_uuid) REFERENCES team(uuid) ON DELETE CASCADE ON UPDATE CASCADE
)
SQL;

        $this->execute($query);
    }

    public function down(): void
    {
        $this->execute('DROP TABLE player');
    }
}
