
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
        <div class="mt-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-info" style="" value="Valider">
        </div>
    </form>

    <?php
        if(isset($activities)):
            $tab = [];
        ?>
            <div class="container mt-3">
                <?php foreach ($activities as $activity):
                if(!isset($tab["$activity[title]"])):
                        $tab["$activity[title]"] = 0;
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="HeaderPanel<?= e($activity['stand']) ?>">
                        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#Panel<?= e($activity['stand']) ?>" aria-expanded="true" aria-controls="Panel<?= e($activity['stand']) ?>">
                            <?= e($activity['title']) ?>
                        </button>
                    </h2>
                    <div id="Panel<?= e($activity['stand']) ?>" class="accordion-collapse collapse" aria-labelledby="HeaderPanel<?= e($activity['stand']) ?>">
                        <?php foreach ($activities as $activity): ?>
                        <?php if((isset($activity['remaining_capacity']) && $activity['remaining_capacity'] > 0) || !isset($activity['remaining_capacity'])): ?>
                        <div class="accordion-body">
                            <p><?= e($activity['desc']) ?></p>
                            <p>Horaire de début: <?= e($activity['start']) ?></p>
                            <p>Horaire de fin: <?= e($activity['end']) ?></p>
                            <p>Niveau: <?= e($activity['alevel']) ?></p>
                            <?php if(isset($activity['remaining_capacity'])): ?>
                                <p><?= e($activity['remaining_capacity']) ?> places restantes</p>
                            <?php else: ?>
                                <p><?= e($activity['capacity']) ?> places restantes</p>
                            <?php endif; ?>
                            <a href="#reservationModal<?= e($activity['id']) ?>" data-bs-toggle="modal" data-bs-target="#reservationModal<?= e($activity['id']) ?>" class="btn btn-primary">Réserver</a>
                        </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>
                <?php endif; endforeach; ?>
                <?php foreach ($activities as $activity): ?>
                <div class="modal fade" id="reservationModal<?=e($activity['id'])?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reserver</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="container" method="post" action="?controller=Reservation&action=booking" novalidate>
                                    <input type="hidden" name="id_activity" value="<?=e($activity['id'])?>">
                                    <h4 class="pt-3 pb-1" style="text-align: left">Combien d'élèves accompagnez vous?</h4>
                                    <select class="form-select w-50"  aria-label="stud_select" name="nb_student">
                                        <option class="h-25" selected>--Choisissez le nombre d'élèves--</option>
                                        <?php
                                        for ($i = 1; $i <= 35; $i++) {
                                            echo "<option value='" . $i . "'>" . $i . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php if($student_level !== null): ?>
                                        <input type="hidden" name="student_level" value="<?=e($student_level)?>">
                                    <?php endif; ?>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Valider"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

