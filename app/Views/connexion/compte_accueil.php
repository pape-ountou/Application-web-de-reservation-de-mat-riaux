<?php
        $session = session();
        $model =model(Db_model::class);
        $login=session()->get('user');
        $statut=$model->recup_role($login);
        if($statut->cpt_role=='A'){
            echo"<h2>Espace d'administration</h2>";
           echo" <br />";

           echo" <h2> Session ouverte ! Bienvenue</h2>";
           echo"<h2>";
                echo esc($session->get('user'));
                echo"! </h2>";
           
        }

            else if($statut->cpt_role=='M'){
                echo"<h2>";
                 echo"<h2>Espace Membre</h2>";
           echo" <br />";

           echo" <h2> Session ouverte ! Bienvenue</h2>";
           echo"<h2>";
                echo esc($session->get('user'));
                echo"! </h2>";
            }
            else{
                 echo"<h2>Espace invité</h2>";
           echo" <br />";

           echo" <h2> Session ouverte ! Bienvenue</h2>";
           echo"<h2>";
                echo esc($session->get('user'));
                echo"! </h2>";
            }
?>
<br><br>

<center><h3>Vos réservations à venir</h3></center>

<?php 
    
    if (!empty($reservations) && is_array($reservations)){
        echo "<table class='table table-hover table-striped table-bordered'>
          <thead class='thead-dark'>
            <tr>
                <th>NOM</th>
                <th>DATE</th>
                <th>Ressource</th>
                <th>Participants</th>

            </tr>
        </thead>
        <tbody>"; 
            foreach ($reservations as $r){
                echo "<tr>
                     <td>".$r['rsr_nom']."</td>
                     <td>".$r['rsr_date']."</td>
                     <td>".$r['res_nom']."</td>
                     <td>".$r['part']."</td>

                     </tr>";
    }

      echo "</tbody>
          </table>";
}
else{
echo "<center><h3>" . "Vous n'avez aucune réservation à venir" . "</h3></center>";

}
     
?>
    


