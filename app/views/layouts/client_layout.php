<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/clients/css/style.css">
    <title>Website</title>
</head>
<body>
    <?php require_once(_DIR_ROOT . "/app/views/components/header.php");?>
    <?php $controller->render($content, $sub_content);?>
    <?php require_once(_DIR_ROOT . "/app/views/components/footer.php");?>

    <script type="text/javascript" src="<?php echo _WEB_ROOT?>/public/assets/clients/js/script.js"></script>
</body>
</html>