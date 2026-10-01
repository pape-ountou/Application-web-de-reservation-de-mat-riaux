<h2><?php echo $titre; ?></h2>
<?= session()->getFlashdata('error') ?>

<?php
// Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
echo form_open('/message/entrer'); ?>
<?= csrf_field() ?>

<label for="code">Code  de suivi : </label>
<input type="code" name="code">
<?= validation_show_error('code') ?>


<input type="submit" name="submit" value="Valider">
</form>