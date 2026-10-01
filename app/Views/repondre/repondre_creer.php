<h2>Répondre au message</h2>

<?php
echo "<p><h3><strong>Sujet :</strong> ". $message->mes_intitule. "</h3></p>
      <p><h3><strong>Question :</strong> ". $message->mes_texte. "</h3></p>
      <p><h3><strong>Email :</strong> ". $message->mes_email. "</h3></p>
      <p><h3><strong>Date :</strong> ". $message->mes_date. "</h3></p>
      <hr>";

echo "<form method='POST' action='https://obiwan.univ-brest.fr/~e21909825/index.php/reponse/reponse_admin/" . $message->mes_code_genere . "'>
    <div class='form-group'>
        <label>Votre réponse</label>
        <textarea class='form-control' name='reponse' required>" 
        . (isset($message->mes_reponse) ? esc($message->mes_reponse) : '') .
        "</textarea>
    </div>

    <button class='btn btn-success mt-3'>répondre</button>
</form>";
?>
