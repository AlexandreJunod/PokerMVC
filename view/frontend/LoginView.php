<?php $title = 'Login'; ?>

<?php ob_start(); ?>
<div class="FormContainerIndex">
    <div class="FormTitle">Connexion</div>
    <div class="FormDesign">
        <div class="FormFieldsIndex"><form method="post" id="FormLogin">Pseudo<input type="text" id="InputIndex" name="PseudoForm" minlength="6" maxlength="13" required autofocus><br><br><br>Mot de passe<input type="password" id="InputIndex" name="PasswordForm" minlength="6" required></form><br></div>
        <div class="FormButton"><button type="submit" form="FormLogin" name="Login">Connexion</button></div>
    </div>
    <div class="FormLink"><a href="index.php?Signup">Pas encore de compte ? Inscrivez-vous !</a></div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('Template.php'); ?>