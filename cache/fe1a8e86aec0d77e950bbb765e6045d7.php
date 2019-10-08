<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=htmlentities("SILO | TEMPLATING ENGINE", ENT_QUOTES, 'UTF-8');?></title>
</head>
<body>
<?php $arr = array("name" => "10")?>
<?php foreach($arr as $name => $age):?><?=$name .  "<br>" . $age?><?php endforeach;?>
<?php for($i = 0;$i <= 10;$i++):?><?=$i . "<br>"?><?php endfor;?>
</body>
</html>