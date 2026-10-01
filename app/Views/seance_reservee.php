<div class="container mt-4">

    <!-- FORMULAIRE EN HAUT -->
    <form method="post">
        <label for="date">Choisir une date :</label>
        <input type="date" name="date" id="date"
               value="<?= esc($date_selectionnee ?? '') ?>" required>

        <button class="btn btn-primary">Voir les réservations</button>
    </form>

    <hr>

    <?php if (!empty($date_selectionnee)): ?>
        <h3>Réservations du <?= esc($date_affichage) ?></h3>
    <?php endif; ?>


    <!-- AFFICHAGE DES RESERVATIONS -->
    <?php if (!empty($reservations_par_ressource)): ?>

        <?php foreach ($reservations_par_ressource as $ressource => $reservations): ?>

            <h4 class="mt-4"><?= esc($ressource) ?></h4>

            <?php foreach ($reservations as $r): ?>
                <p>
                    <strong>Nom de la reservation :</strong> <?= esc($r->rsr_nom) ?><br>

                    <strong>Heure :</strong> <?= date("H:i", strtotime($r->rsr_date)) ?><br>

                    <strong>Participants :</strong>
                    <?= !empty($r->participants) ? esc($r->participants) : "Aucun participant" ?><br>
                </p>

                <?php if (strtotime($r->rsr_date) < time() && !empty($r->rsr_bilan_reservation)): ?>
                    <p><strong>Bilan :</strong><br>
                        <?= nl2br(esc($r->rsr_bilan_reservation)) ?>
                    </p>
                <?php endif; ?>

                <hr>
            <?php endforeach; ?>

        <?php endforeach; ?>


    <!-- SI AUCUNE RESERVATION POUR LA DATE -->
    <?php elseif (!empty($date_selectionnee)): ?>

        <p>Aucune réservation pour cette date.</p>

    <?php endif; ?>

</div>
