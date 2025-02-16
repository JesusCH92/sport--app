<!-- View/base.php -->
<?php

use App\Player\Infrastructure\WebController\PlayerCreatorController;
use App\Team\Infrastructure\WebController\TeamController;
use App\Team\Infrastructure\WebController\TeamCreatorController;

/** @var string $title*/
/** @var string $content*/

$teamsRoute = TeamController::PATH;
$teamCreatorRoute = TeamCreatorController::PATH;
$playerCreatorRoute = PlayerCreatorController::PATH;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>

<a href="<?= htmlspecialchars($teamsRoute) ?>">Team Collection</a>
<a href="<?= htmlspecialchars($teamCreatorRoute) ?>">Team Creator</a>
<a href="<?= htmlspecialchars($playerCreatorRoute) ?>">Player Creator</a>

<?= $content ?>

</body>
</html>