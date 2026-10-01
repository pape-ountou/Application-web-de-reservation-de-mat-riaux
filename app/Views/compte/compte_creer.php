<h2><?php echo $titre; ?></h2>
<?= session()->getFlashdata('error') ?>

<?php
// Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
echo form_open('/compte/creer'); ?>
<?= csrf_field() ?>

<label for="pseudo">Pseudo : </label>
<input type="input" name="pseudo">
<?= validation_show_error('pseudo') ?>

<label for="mdp">Mot de passe : </label>
<input type="password" name="mdp">
<?= validation_show_error('mdp') ?>

<input type="submit" name="submit" value="Créer un nouveau compte">
</form>