<!-- View/team/index.php -->
<?php

use App\Team\Domain\Entity\Team;

/** @var Team ...$teams */

?>
<h1>Team!</h1>
<p>Welcome to the team page.</p>

<table border="1">
    <thead>
    <tr>
        <th>UUID</th>
        <th>Name</th>
        <th>City</th>
        <th>Created At</th>
        <th>Players</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= htmlspecialchars($team->uuid()) ?></td>
            <td><?= htmlspecialchars($team->name()) ?></td>
            <td><?= htmlspecialchars($team->city()) ?></td>
            <td><?= htmlspecialchars($team->createdAt()->format('Y-m-d')) ?></td>
            <td>
                <a href="/player?teamUuid=<?= urlencode($team->uuid()) ?>">
                    Players
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>