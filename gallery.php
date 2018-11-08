<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
$dir = "gallery/";
$scan = array_diff(scandir($dir, 1), array('..', '.', '.DS_Store'));
foreach ($scan as $i) {
    ?>

    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">

                    <?php echo '<img class="rs" src="' . $dir . $i . '"/>';
                    echo '<br>' . $dir . $i ?>

                </div>
            </div>
        </div>
    </div>

<?php } ?>

</body>
</html>

