<?php
//The Access was accepted after a login or a signup
function AccessAccepted($Pseudo)
{
    $_SESSION['Pseudo'] = $Pseudo;
    ListInfoGames();
}