<!-- View/player-updater/index.php -->
<?php

use App\Player\Domain\Entity\Player;
use App\Player\Infrastructure\WebController\PlayerUpdaterController;
use App\Team\Domain\Entity\Team;

/** @var Team ...$teams */
/** @var Player $player */

$updateRoute = PlayerUpdaterController::PATH . '?playerUuid=' . $player->uuid();
?>
<h1>Player Updater!</h1>
<p>Welcome to the player updater page.</p>

<form action="<?= htmlspecialchars($updateRoute) ?>" method="POST">
    <div>
        <label for="name">Player Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($player->name()->value()) ?>" required>
    </div>

    <div>
        <label for="number">Player Number:</label>
        <input type="number" id="number" name="number" value="<?= htmlspecialchars($player->number()->value()) ?>" required>
    </div>

    <div>
        <label for="team_uuid">Team:</label>
        <select id="team_uuid" name="team_uuid" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?= htmlspecialchars($team->uuid()) ?>"
                    <?= $team->uuid() === $player->teamUuid() ? ' selected' : '' ?>>
                    <?= htmlspecialchars($team->name()->value()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="is_captain">Is Captain?</label>
        <input type="checkbox"
               id="is_captain"
               name="is_captain"
               value="1"
            <?= $player->isCaptain() ? 'checked' : '' ?>>
    </div>

    <div>
        <button type="submit">Update Player</button>
    </div>
</form>