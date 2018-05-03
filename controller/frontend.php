<?php

require('model/frontend.php');

//List the options of the players and of the tables 
function ListInfoGames()
{
    $InfoGames = GetInfoGames();
    
    foreach($InfoGames as $InfoGame)
    {
        $Table1 = array(
        array('MoneySeat' => $InfoGame['MoneySeat'], 'BetSeat' => $InfoGame['BetSeat'], 'HandSeat' => $InfoGame['HandSeat'], 'OrderSeat' => $InfoGame['OrderSeat'], 'fkGameSeat' => $InfoGame['fkGameSeat'], 'fkStatusSeat' => $InfoGame['fkStatusSeat'], 'fkPlayerSeat' => $InfoGame['fkPlayerSeat']));
    }
    require('view/frontend/TableView.php');
}

//Login form
function DoLogin()
{
    //Check if the Form was sent
    if(isset($_POST['PseudoForm']))
    {
        $Pseudo = $_POST['PseudoForm']; //Pseudo gived by the user who tries to sign up
        $Password = $_POST['PasswordForm']; //Password gived by the user who tries to sign up
        $InfoLogins = Login($Pseudo, $Password); //Check if the account exists
        
        foreach($InfoLogins as $InfoLogin)
        {
            $PasswordPlayer = InfoLogin['PasswordPlayer'];
            $HashPassword = InfoLogin['HashPassword'];
        }
        
        if($InfoLogins->rowCount() > 0) //If datas are returned, the pseudo exists
        {
            if($PasswordPlayer != $HashPassword) //Check if the password gived by the user is the same than the password hashed of the data base
            {
                $Error = "Le mot de passe est erroné";
                $Pseudo = NULL; //Dont let the session start
            }
        } 
        else //No datas were returned, the pseudo was not find
        {
            $Error = "Le pseudo est erroné";
            $Pseudo = NULL; //Dont let the session start
        }
    }
    require('view/frontend/LoginView.php');
}

//Signup form
function DoSignup()
{
    //Check if the Form was sent
    if(isset($_POST['PseudoForm']))
    {
        $Pseudo = $_POST['PseudoForm']; //Pseudo gived by the user who tries to sign up
        $Password = $_POST['PasswordForm']; //Password gived by the user who tries to sign up
        $InfosSignup = CheckAccount($Pseudo); //Check if the account exists
        
        if($InfosSignup->rowCount() > 0)
        {
            $Error = "Ce pseudo existe déjà"; //Varriable to show the error message
        }
        else
        {
            if (preg_match("#[^a-zA-Z0-9]#", $Password)) //Check if the password matches with the required criterias
            { 
                $InfosSignup2 = Signup($Pseudo, $Password); //Create the account
            }
            else //The password doesn't matches with the required criterias
            {
                $Error = "Le mot ne correspond pas aux critères"; //Varriable to show the error message
            }
        }
    }
    require('view/frontend/SignupView.php');
}


/*function listPosts()
{
    $posts = getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}*/