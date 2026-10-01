
<?php
   echo"<a class ='btn btn-primary btn-sm' href='https://obiwan.univ-brest.fr/~e21909825/index.php/compte/creer'> + invite</a>";
?>

<?php
   echo"<a class ='btn btn-primary btn-sm' href=''> Creer un compte</a>";
?>
<h1><?= esc($titre) ?></h1><br />

<?php
if (!empty($logins) && is_array($logins)) {
   

    echo "<table class='table table-hover table-striped table-bordered'>
          <thead class='thead-dark'>
          <tr>
              <th>Pseudos</th>
              <th>Noms</th>
              <th>prénoms</th>
              <th>Emails</th>
              <th>Statuts</th>
              <th>Etats</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>";

    foreach($logins as $pseudos) {
        echo "<tr>
              <td>" .$pseudos['cpt_pseudo']. "</td>
              <td>" .$pseudos['pfl_nom']. "</td>
              <td>" .$pseudos['pfl_prenom']. "</td>
              <td>" .$pseudos['pfl_email']. "</td>
              <td>" . $pseudos['cpt_role']. "</td>
            <td>" . $pseudos['cpt_etat']. "</td>
            <td>  
                <a class='btn btn-primary btn-sm-3' href=''>
                  Détails
              </a>

              <a class='btn btn-primary btn-sm-3' href=''>
                  Modifier
              </a>
              <a class='btn btn-primary btn-sm-3' href=''>
                  Supprimer
              </a>
              <a class='btn btn-primary btn-sm-3' href=''>
                  Désactiver
              </a>
              </td>
              </tr>";
    }
    
    echo "</tbody>
          </table>";
} else {
    echo "Aucun compte pour le moment";
}
?>
