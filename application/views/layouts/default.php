<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/public/css/styles.css" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>
<body>
<div class="container mt-2">
    <?php
        if (isErrors()) {
            echo '<div class="alert alert-danger" role="alert">';
            showErrors();
            echo '</div>';
        }
    ?>

	<?php echo $content; ?>
</div>
</body>
</html>
