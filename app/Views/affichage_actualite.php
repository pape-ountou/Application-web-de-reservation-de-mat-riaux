<h1><?php echo $titre;?></h1><br />
<?php
if (isset($news)){
echo $news->act_id;
echo(" -- ");
echo $news->act_titre;
}
else {
echo  '<center><h3>'."Aucune actualité pour l'instant !".'</center></h3>';
}
?>