<h1><?= esc($titre) ?></h1><br />

<style>
/* Colorer uniquement la cellule de réponse vide */
td.reponse-vide {
    background-color: #ffcccc !important;
    font-weight: bold;
}
</style>

<?php 
if (!empty($messages) && is_array($messages)) {
    echo "<table class='table table-hover table-bordered table-striped'>
            <thead class='table-dark'>
                <tr>
                    <th>Sujet</th>
                    <th>Question</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Reponse</th>
                    <th>Code Suivi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";
    
    foreach ($messages as $msg) {
        // Détection réponse vide
        $reponseVide = empty($msg['mes_reponse']) || trim($msg['mes_reponse']) === '';
        $classeReponse = $reponseVide ? 'reponse-vide' : '';
        
        echo "<tr>
                <td>" . esc($msg['mes_intitule']) . "</td>
                <td>" . esc($msg['mes_texte']) . "</td>
                <td>" . esc($msg['mes_email']) . "</td>
                <td>" . esc($msg['mes_date']) . "</td>
                <td class='$classeReponse'>";
        
        if ($reponseVide) {
            echo "Non répondu";
        } else {
            echo esc($msg['mes_reponse']);
        }
        
        echo "</td>
                <td>" . esc($msg['mes_code_genere']) . "</td>
                <td>
                    <a class='btn btn-primary btn-sm' 
                       href='https://obiwan.univ-brest.fr/~e21909825/index.php/reponse/reponse_admin/" . esc($msg['mes_code_genere']) . "'>
                        repondre
                    </a>
                </td>
              </tr>";
    }
    
    echo "</tbody></table>";
} else {
    echo "<p class='alert alert-info'>Aucune demande de visiteur pour le moment !</p>";
}
?>