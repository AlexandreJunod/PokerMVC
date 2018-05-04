<?php $title = 'Signup'; ?>

<?php ob_start(); ?>
<div class="FormContainerSignup">
    <div class="FormTitle">Inscription</div>
    <div class="FormDesign">
        <div class="FormFieldsSignup"><form method="post" id="FormSignup">Pseudo<input type="text" id="InputSignup" name="PseudoForm" minlength="6" maxlength="13" required autofocus><br><br><br>Mot de passe<input type="password" id="InputSignup" name="PasswordForm" minlength="6" required></form><br></div>
        <div class="FormCritereaSignup"><br>Doit contenir 6 à 14 caractères<br><br><br> Doit contenir :<br>&nbsp;&nbsp;- 6 caractères ou +<br>&nbsp;&nbsp;- 1 caractère spécial</div>
        <div class="FormButton"><button type="submit" form="FormSignup" name="Signup">Inscription</button></div>
    </div>
    <div class="FormLink"><a href="index.php">Déjà un compte ? Connectez-vous !</a></div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('Template.php'); ?>