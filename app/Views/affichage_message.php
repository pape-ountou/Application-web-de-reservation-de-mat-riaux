<h2><?php echo '<center><h1>'.$titre.'</h1></center>'; ?></h2>
<?php
if (isset($mes)){
echo '<center><h3>';
echo 'Sujet : '.$mes->mes_intitule;
echo '<br>';

echo 'Question : '.$mes->mes_texte;
echo '<br>';

echo 'Reponse : '.$mes->mes_reponse;
echo '<br>';

echo 'Email : '.$mes->mes_email;
echo '<br>';

echo 'Date : '.$mes->mes_date;
echo '<br>';

echo 'Correspondant : '.$mes->cpt_id;
echo '</h3></center>';
}
else {
echo  '<center><h3>'."Pas de message correspondant à ce code de suivi !".'</h3></center>';
}
?>