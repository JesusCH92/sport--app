<!-- View/player-creator/index.php -->
<?php

use App\Team\Domain\Entity\Team;

/** @var Team ...$teams */

?>
<h1>Player Creator!</h1>
<p>Welcome to the player creator page.</p>

<form action="/player-creator" method="POST">
    <div>
        <label for="name">Player Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="number">Player Number:</label>
        <input type="number" id="number" name="number" required>
    </div>

    <div>
        <label for="team_uuid">Team:</label>
        <select id="team_uuid" name="team_uuid" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?= htmlspecialchars($team->uuid()) ?>"><?= htmlspecialchars($team->name()) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="is_captain">Is Captain?</label>
        <input type="checkbox" id="is_captain" name="is_captain" value="1">
    </div>

    <div>
        <button type="submit">Create Player</button>
    </div>
</form>