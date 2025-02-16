<!-- View/player/index.php -->
<?php

use App\Player\Domain\Entity\Player;
use App\Player\Infrastructure\WebController\PlayerUpdaterController;
use App\Team\Domain\Entity\Team;

/** @var Player ...$players */
/** @var Team $team*/

$updateRoute = PlayerUpdaterController::PATH . '?playerUuid=';
?>
<h1>Team <?= htmlspecialchars($team->name()) ?>!</h1>

<a href="/player-creator">Create Player</a>

<table border="1">
    <thead>
    <tr>
        <th>UUID</th>
        <th>Name</th>
        <th>Number</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($players as $player): ?>
        <tr>
            <td><?= htmlspecialchars($player->uuid()) ?></td>
            <td><?= htmlspecialchars($player->name()) ?></td>
            <td><?= htmlspecialchars($player->number()) ?></td>
            <td>
                <a href="<?= $updateRoute . htmlspecialchars($player->uuid()) ?>">Update</a>
                <a href="/#">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>