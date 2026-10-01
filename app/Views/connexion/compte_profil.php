<?php
        $session = session();
        $model =model(Db_model::class);
        $login=session()->get('user');
        $statut=$model->recup_role($login);
        if($statut->cpt_role=='A'){
            echo"<center><h2>Espace d'administration</h2></center>";
           echo" <br />"; 
        }

            else if($statut->cpt_role=='M'){
                echo"<h2>";
                 echo"<center><h2>Espace Membre</h2></center>";
           echo" <br />";

            }
            else{
                 echo"<center><h2>Espace invité</h2></center>";
           echo" <br />";
            }
?>
<br><br>
<?php
$session = session();
echo "<center>";
echo "<h3>" . $le_message . "</h3><br>";

// Vérifier si le profil existe (cas des invités)
if (empty($profil)) {
    echo "<br><br>";
    echo "<h3>Les comptes invités ne disposent pas de profil.</h3>";
}
// Cas : Profil existant
else {
    echo "<h3>Nom : " . $profil->pfl_nom . "</h3><br>";
    echo "<h3>Prénom : " . $profil->pfl_prenom . "</h3><br>";
    echo "<h3>Email : " . $profil->pfl_email . "</h3><br>";
    echo "<h3>Statut de ce compte : " . $profil->cpt_role . "</h3><br>";
   
}
echo "</center>";
?>