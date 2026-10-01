<h2><?php echo $titre; ?></h2>
<?= session()->getFlashdata('error') ?>

<?php echo form_open('/compte/ajout_ressource'); ?>
<?= csrf_field() ?>

<div>
  <label for="nom">Nom :</label><br>
  <input type="text" name="nom" id="nom"><br>
  <?= validation_show_error('nom') ?>
</div>

<br>

<div>
  <label for="descriptif">Descriptif :</label><br>
  <input type="text" name="descriptif" id="descriptif"><br>
  <?= validation_show_error('descriptif') ?>
</div>

<br>



<div>
  <label for="liste">liste :</label><br>
  <input type="liste" name="liste" id="liste"><br>
  <?= validation_show_error('liste') ?>
</div>
<br>
<div>
  <label for="jauge">Jauge :</label><br>
  <input type="jauge" name="jauge" id="jauge"><br>
  <?= validation_show_error('jauge') ?>
</div>
<br>

<input type="submit" name="submit" value="Valider">
</form>