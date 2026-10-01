
<?php
    echo "<h3>" . $titre . "</h3>";

?>

<?php if (!empty($message)) : ?>
    <div style="color:red; font-weight:bold;"><?= esc($message) ?></div>
<?php endif; ?>



<?= session()->getFlashdata('error') ?>
<?php echo form_open('/compte/connecter'); ?>
<?= csrf_field() ?>
<label for="pseudo">Pseudo : </label>
<input type="input" name="pseudo" value="<?= set_value('pseudo') ?>">
<?= validation_show_error('pseudo') ?>
<label for="mdp">Mot de passe : </label>
<input type="password" name="mdp">
<?= validation_show_error('mdp') ?>
<input type="submit" name="submit" value="Se connecter">
</form>