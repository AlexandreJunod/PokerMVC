<?php $title = 'Poker'; ?>

<?php ob_start(); ?>

<?php for($i = 1; $i <= $InfoTables->rowCount(); $i++) //For every table counted, build an array
{ 
            $GameNB = 'Game'.$i; //Create a variable, for get the name of the array to show
            $TableNB = 'Table'.$i; //Create a variable, for get the name of the array to show
?>

    <!-- Show games -->
    <h3>Game <?= $i ?></h3>
    <table border='1'>
        <tr>
           <td>PseudoPlayer</td>
           <td>MoneySeat</td>
           <td>BetSeat</td>
           <td>HandSeat</td>
           <td>OrderSeat</td>
           <td>fkGameSeat</td>
           <td>DescriptionStatus</td>
       </tr>

    <?php foreach($$GameNB as $GameShow) //Lecture de chaque ligne du tableau
    { 
        echo "<tr>";
        foreach($GameShow as $cle=>$valeur){ //Lecture de chaque tableau de chaque ligne
            echo "<td>".$valeur."</td>"; //echo $cle.': '.$valeur.'&nbsp&nbsp&nbsp&nbsp&nbsp';  //Affichage
        }
        echo "</tr>";
    } ?>
    </table>

    <!-- Show tables -->
    <h3>Table <?= $i ?></h3>
    <table border='1'>
        <tr>
           <td>PotGame</td>
           <td>BoardGame</td>
           <td>BlindGame</td>
           <td>DealerGame</td>
           <td>HourStartGame</td>
           <td>TimeToIncreaseBlind</td>
       </tr>

   <?php foreach($$TableNB as $TableShow) //Lecture de chaque ligne du tableau
    { 
        echo "<tr>";
        foreach($TableShow as $cle=>$valeur){ //Lecture de chaque tableau de chaque ligne
            echo "<td>".$valeur."</td>"; //echo $cle.': '.$valeur.'&nbsp&nbsp&nbsp&nbsp&nbsp';  //Affichage
        }
        echo "</tr>";
    } ?>
    </table><br><br>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('Template.php'); ?>