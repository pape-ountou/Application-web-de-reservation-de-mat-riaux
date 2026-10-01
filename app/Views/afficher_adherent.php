
<br><br>
<?php

//echo '<center><h3>' . $titre .'</h3></center>';
echo"<br><br>";
?>
<?php 
    
    if (!empty($adherent) && is_array($adherent)){
        echo "<table class='table table-hover table-striped table-bordered'>
          <thead class='thead-dark'>
            <tr>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>EMAIL</th>
                <th>NUMERO TELEPHONE</th>
                

            </tr>
        </thead>
        <tbody>"; 
            foreach ($adherent as $a){
                echo "<tr>
                     <td>".$a['pfl_nom']."</td>
                     <td>".$a['pfl_prenom']."</td>
                     <td>".$a['pfl_email']."</td>
                     <td>".$a['pfl_num_telephone']."</td>
                
                     </tr>";
    }

      echo "</tbody>
          </table>";
}
else{
echo "<center><h3>" . "Aucun Adherent  pour le moment !" . "</h3></center>";

}
     
?>
    


