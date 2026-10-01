<h2><?php echo $titre; ?></h2>
<?php
if (! empty($logins) && is_array($logins))
{
    echo"le nombre de comptes total:  $nombre_de_comptes->total ";
    echo "<br>";
foreach ($logins as $pseudos)
{

echo "<br />";
echo " -- ";
echo $pseudos["cpt_pseudo"];
echo " -- ";
echo "<br />";

}
}
else {
echo("<h3>Aucun compte pour le moment</h3>");
}
?>