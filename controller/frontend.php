<?php

require('model/frontend.php');

if(isset($Pseudo))
{
    $Pseudo = $_SESSION['Pseudo'];
}

//List the informations of the players and of the tables 
function ListInfoGames()
{
    $InfoTables = GetInfoTables(); //Collect informations about the tables
    
    foreach($InfoTables as $InfoTable)
    {
        $NbTableGame = $InfoTable['idGame']; //Take the number of the game
        $GameNB = 'Game'.$NbTableGame; //Create a variable, for get the name of the array to build
        $TableNB = 'Table'.$NbTableGame; //Create a variable, for get the name of the array to build
        
        $InfoPlayers = GetInfoPlayers($NbTableGame); //Collect informations about the players 
        
        //Create the array with informations about the table. $$ Uses the value of the variable as variable
        $$TableNB = array( 
        array('PotGame' => $InfoTable['PotGame'], 'BoardGame' => $InfoTable['BoardGame'], 'BlindGame' => $InfoTable['BlindGame'], 'DealerGame' => $InfoTable['DealerGame'], 'HourStartGame' => $InfoTable['HourStartGame'], 'TimeToIncreaseBlind' => $InfoTable['TimeToIncreaseBlind']));
        
        $$GameNB = array(); //Create the array with informations about the users. $$ Uses the value of the variable as variable
        
        foreach($InfoPlayers as $InfoPlayer)
        {
            //Add informationns about the users in the array. 
            array_push($$GameNB, array('PseudoPlayer' => $InfoPlayer['PseudoPlayer'], 'MoneySeat' => $InfoPlayer['MoneySeat'], 'BetSeat' => $InfoPlayer['BetSeat'], 'HandSeat' => $InfoPlayer['HandSeat'], 'OrderSeat' => $InfoPlayer['OrderSeat'], 'fkGameSeat' => $InfoPlayer['fkGameSeat'], 'DescriptionStatus' => $InfoPlayer['DescriptionStatus']));
        }
    }
    require('view/frontend/TableView.php');
}

//Login form
function DoLogin($Pseudo, $Password)
{
    //Check if the Form was sent
    if(isset($Pseudo) && isset($Password))
    {
        $InfoLogins = Login($Pseudo, $Password); //Check if the account exists
        
        if($InfoLogins != NULL) //If datas are returned, the pseudo exists
        {
            extract($InfoLogins); //$idPlayer, $PseudoPlayer, $PasswordPlayer, $HashPassword
            
            if($PasswordPlayer == $HashPassword) //Check if the password gived by the user is the same than the password hashed of the data base
            {
                AccessAccepted($Pseudo);
                return;
            }
            else
            {
                $Error = "Le mot de passe est erroné";
                unset($_SESSION['Pseudo']); //Dont let the session start     
                unset($Pseudo); //Dont let the session start;
            }
        } 
        else //No datas were returned, the pseudo was not find
        {
            $Error = "Le pseudo est erroné";
            unset($_SESSION['Pseudo']); //Dont let the session start     
            unset($Pseudo); //Dont let the session start;
        }
    }
    require('view/frontend/LoginView.php');
}

//Signup form
function DoSignup($Pseudo, $Password)
{
    //Check if the Form was sent
    if(isset($Pseudo) && isset($Password))
    {
        $InfosSignup = CheckAccount($Pseudo); //Check if the account exists
        
        if($InfosSignup->rowCount() > 0)
        {
            $Error = "Ce pseudo existe déjà"; //Varriable to show the error message
            unset($_SESSION['Pseudo']); //Dont let the session start     
            unset($Pseudo); //Dont let the session start;
        }
        else
        {
            if (preg_match("#[^a-zA-Z0-9]#", $Password)) //Check if the password matches with the required criterias
            { 
                $InfosSignup2 = Signup($Pseudo, $Password); //Create the account
                AccessAccepted($Pseudo);
                return;
            }
            else //The password doesn't matches with the required criterias
            {
                $Error = "Le mot ne correspond pas aux critères"; //Varriable to show the error message
                unset($_SESSION['Pseudo']); //Dont let the session start     
                unset($Pseudo); //Dont let the session start;
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