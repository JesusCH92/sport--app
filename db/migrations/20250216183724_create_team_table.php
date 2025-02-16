<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTeamTable extends AbstractMigration
{
    public function up(): void
    {
        $query = <<<SQL
CREATE TABLE team
(
    uuid       char(36)     NOT NULL
        PRIMARY KEY,
    name       varchar(250) NOT NULL,
    city       varchar(150) NOT NULL,
    created_at datetime     NOT NULL
)
SQL;

        $this->execute($query);
    }

    public function down(): void
    {
        $this->execute('DROP TABLE team');
    }
}
