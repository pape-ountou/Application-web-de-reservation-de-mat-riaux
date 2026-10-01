<h2><?php echo $titre; ?></h2>
<?= session()->getFlashdata('error') ?>

<?php echo form_open('/contact/creer'); ?>
<?= csrf_field() ?>

<div>
  <label for="sujet">Sujet :</label><br>
  <input type="text" name="sujet" id="sujet"><br>
  <?= validation_show_error('sujet') ?>
</div>

<br>

<div>
  <label for="question">Question :</label><br>
  <input type="text" name="question" id="question"><br>
  <?= validation_show_error('question') ?>
</div>

<br>

<div>
  <label for="email">Adresse e-mail :</label><br>
  <input type="email" name="email" id="email"><br>
  <?= validation_show_error('email') ?>
</div>

<br>

<input type="submit" name="submit" value="Valider">
</form>