<?php $title = 'Poker'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
foreach($Table1 as $ligne){
        // Lecture de chaque tableau de chaque ligne
	foreach($ligne as $cle=>$valeur){
                // Affichage
		echo $cle.': '.$valeur.'<br>';
	}
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>