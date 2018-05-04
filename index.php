<?php
session_start();
require('controller/frontend.php');

//error_log(print_r($_POST, 1));

try
{
    if(isset($_SESSION['Pseudo']))
    {
        ListInfoGames();
    }
    elseif(isset($_GET['Signup']))
    {
        if(isset($_POST['Signup']))
        {
            DoSignup($_POST['PseudoForm'], $_POST['PasswordForm']);
        }
        else
        {
            DoSignup;
        }
    }
    elseif(isset($_POST['Login']))
    {
        DoLogin($_POST['PseudoForm'], $_POST['PasswordForm']);
    }
    else
    {
        DoLogin(NULL, NULL);
    }    
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}
    

/*try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}*/