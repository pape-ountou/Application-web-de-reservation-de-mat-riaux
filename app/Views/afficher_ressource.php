

<div class="mb-3">
    <a href="https://obiwan.univ-brest.fr/~e21909825/index.php/compte/ajout_ressource" 
       class="btn btn-success">
       <i class="bi bi-plus"></i> Ajouter une ressource
    </a>
</div>


<br><br>
<br><br>;


<?php 
    
if (!empty($ressource) && is_array($ressource)){
echo "<table class='table table-hover table-striped table-bordered'>
          <thead class='thead-dark'>
            <tr>
                <th>INTITULES</th>
                <th>JAUGES</th>
                <th>PHOTOS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>"; 
foreach ($ressource as $r){
echo "<tr>
        <td>".$r['res_nom']."</td>
        <td>".$r['res_jauge']."</td>
        <td>
            <img src='".base_url('bootstrap2/img/' . $r['res_chemin_fichier'])."'
             alt='Image ressource' 
             width='50'></td>
        <td>
            <a class='btn btn-primary btn-sm' 
               href='https://obiwan.univ-brest.fr/~e21909825/index.php/compte/gestion_ressource'>
                Details
            </a>
            <a class='btn btn-danger btn-sm' 
               href='https://obiwan.univ-brest.fr/~e21909825/index.php/compte/supp_ressource/".$r['res_id']."' 
               onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette ressource ?');\">
                Supprimer
            </a>
        </td>
      </tr>";
    }
echo "</tbody>
          </table>";
}
else{
echo "<center><h3>" . "Aucune ressource reservable pour l'instant !" . "</h3></center>";
}
?>
    


