
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "My Page" ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?= $content ?? '' ?>
    <?= $scripts ?? '' ?>
</body>
</html>
