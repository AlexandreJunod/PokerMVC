<?php

//Connect to the database 
function ConnectDB()
{
    //Required datas for connect to a database
    $hostname = 'localhost';
    $dbname = 'poker';
    $username = 'root';
    $password = '';

    // PDO = Persistant Data Object
    // Between "" = Connection String
    $connectionString = "mysql:host=$hostname; dbname=$dbname";

    $dbh = new PDO($connectionString, $username, $password);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->exec("SET NAMES UTF8");
    
    return $dbh;
}

//Select datas about the tables
function GetInfoTables()
{
    $dbh = ConnectDB();
    $req = $dbh->query("SELECT idGame, PotGame, BoardGame, BlindGame, DealerGame, HourStartGame, (SELECT ValueInt FROM poker.settings WHERE NameSettings = 'TimeToIncreaseBlind') as TimeToIncreaseBlind FROM poker.game");
    
    return $req;
}

//Select datas about the players
function GetInfoPlayers($NbTableGame)
{
    $dbh = ConnectDB();
    $req = $dbh->query("SELECT PseudoPlayer, MoneySeat, BetSeat, HandSeat, OrderSeat, fkGameSeat, DescriptionStatus FROM poker.seat INNER JOIN poker.player ON fkPlayerSeat = idPlayer INNER JOIN poker.status ON fkStatusSeat = idStatus WHERE fkGameSeat = '$NbTableGame'");

    return $req; 
}

//Select the player with the informations sent by the user
function Login($Pseudo, $Password)
{
    $dbh = ConnectDB();
    $req = $dbh->query("SELECT idPlayer, PseudoPlayer, PasswordPlayer, PASSWORD('$Password') as HashPassword FROM poker.player WHERE PseudoPlayer = '$Pseudo'");
    $req->execute(array());
    $reqArray = $req->fetch();

    return $reqArray;
}

//Check if the account exists
function CheckAccount($Pseudo)
{
    $dbh = ConnectDB();
    $req = $dbh->query("SELECT idPlayer, PseudoPlayer, PasswordPlayer FROM poker.player WHERE PseudoPlayer = '$Pseudo'");
    
    return $req;
}

//Create the account of the user
function Signup($Pseudo, $Password)
{    
    $dbh = ConnectDB();
    $req = $dbh->query("INSERT INTO poker.Player (PseudoPlayer, PasswordPlayer) VALUES ('$Pseudo', PASSWORD('$Password'))");
    
    return $req;
}

/*
function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'dbuser', '');
    return $db;
}
*/