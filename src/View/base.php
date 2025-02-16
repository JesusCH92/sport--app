<!-- View/base.php -->
<?php
/** @var string $title*/
/** @var string $content*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>

<a href="/team-creator">Team</a>

<?= $content ?>

</body>
</html>