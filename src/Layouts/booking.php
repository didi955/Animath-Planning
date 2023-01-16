<div class="">
    <form method="post" action="?controller=Reservation&action=filter">
        <div class= "pb-4">
        <h4 class="pb-1"  style="text-align: left;">Quel est le niveau de vos élèves ?</h4>
        <select class="form-select w-50" aria-label="Default select example" name="stud_level">
            <option selected>--Choisissez le niveau de vos élèves--</option>
            <option value="Primaire">Primaire</option>
            <option value="Collège">Collège</option>
            <option value="Lycée">Lycée</option>
        </select>
        </div>

        <div class="border-2 border-bottom" style="color: #98c1d9"></div>
        <h4 class="pt-3 pb-1" style="text-align: left">Quelles sont vos disponiblités ?</h4>
        <label class="fs-7 pt-1" style="justify-content: left" for="meeting-time_start">Début :</label>
        <input class="fs-6  w-100 h-30" type="datetime-local" id="meeting-time_start" name="meeting-time_start" value="2023-05-25T07:00" min="2023-05-25T07:00" max="2023-05-26T19:00">

        <label class="fs-7" style="justify-content: left" for="meeting-time_end">Fin :</label>
        <input class="fs-6  w-100 h-30" type="datetime-local" id="meeting-time_end" name="meeting-time_end" value="2023-05-25T18:00" min="2023-05-25T07:00" max="2023-05-26T19:00">
        <br><br>
        <div class="border-2 border-bottom"></div>
        <h4 class="pt-3 pb-1" style="text-align: left">Combien d'élèves accompagnez vous?</h4>
        <select class="form-select w-50"  aria-label="stud_select" name="stud_number">
            <option class="h-25" selected>--Choisissez le nombre d'élèves--</option>
            <?php
            for ($i = 1; $i <= 35; $i++) {
                echo "<option value='" . $i . "'>" . $i . "</option>";
            }
            ?>
        </select>
        <div class="mt-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-info" style="" value="Valider">
        </div>
    </form>

    <?php
        if(isset($activities)):?>
            <div>
                <h4 class="pt-3 pb-1" style="text-align: left">Résultats de votre recherche</h4>
                <div class="row">
                    <?php foreach ($activities as $activity): ?>
                        <?php if((isset($activity['remaining_capacity']) && $activity['remaining_capacity'] > 0) || !isset($activity['remaining_capacity'])): ?>
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <h5 class="card-title"><?= e($activity['title']) ?></h5>
                                <div class="card-body">
                                    <p><?= e($activity['desc']) ?></p>
                                    <p>Horaire de début: <?= e($activity['start']) ?></p>
                                    <p>Horaire de fin: <?= e($activity['end']) ?></p>
                                    <p>Niveau: <?= e($activity['alevel']) ?></p>
                                    <?php if(isset($activity['remaining_capacity'])): ?>
                                        <p><?= e($activity['remaining_capacity']) ?> places restantes</p>
                                    <?php else: ?>
                                        <p><?= e($activity['capacity']) ?> places restantes</p>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <a href="#confirmBooking<?= e($activity['id']) ?>" class="btn btn-primary">Réserver</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
