<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div class='ErrorMsg'><?= @$Error; ?></div>
        <?= $content ?>
    </body>
</html>

<?php 
if(isset($Pseudo)) //&& !isset($CanSaveSession)
    {
        $_SESSION['Pseudo'] = $Pseudo; 
    }
?>