<div class="ps-5 container">
    <div class="ps-5 ms-5 row gap-5">
        <?php foreach ($stands as $stand):
            $id = $stand->getId();
            $title = $stand->getTitle();
            $desc = $stand->getDesc();
            $activities = $stand->getActivities();?>
            <div class="modal fade" id="<?php echo e("standCalendar$id") ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body" style="height: 50rem">
                            <div class="h-75" id="calendar<?php echo e("$id") ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="buttonAjout<?php echo e("$id")?>" data-bs-toggle="modal" data-bs-target="<?php echo e("standAjout$id") ?>" class="btn btn-secondary">Ajouter</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow col-3" style="height: 15rem">
                <div class="card-header p-3">
                    <?php echo e("$title") ?>
                </div>
                <div class="card-body overflow-scroll p-3">
                    <?php echo e("$desc"); ?>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="<?php echo e("#standCalendar$id")?>" data-bs-toggle="modal">Gerer le planing</a>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let calendarEl = document.getElementById('calendar<?php echo e("$id") ?>');
                    let calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridDay',
                        locale: 'fr',
                        <!--editable: true,-->
                        allDaySlot: false,
                        slotMinTime: '08:30:00',
                        slotMaxTime: '19:00:00',
                        events: [
                            <?php foreach ($activities as $activity):
                            $start = $activity->getStart();
                            $end = $activity->getEnd();
                            $capacity = $activity->getCapacity();
                            $student_level = $activity->getStudentLevel();
                            ?>
                            {
                                title: '<?php echo e("$title") ?>',
                                start: '<?php echo e("$start") ?>',
                                end: '<?php echo e("$end") ?>',
                                capacity: '<?php echo e("$capacity") ?>',
                                studentLevel: '<?php echo e("$student_level") ?>'
                            }
                            <?php endforeach;?>
                        ]
                    });
                    calendar.render();
                    document.getElementById('buttonAjout<?php echo e("$id")?>').addEventListener("click",()=>{
                        console.log(calendar.getCurrentData())
                    })
                });
            </script>
        <?php endforeach; ?>
            $id = $stand->getId();
            $title = $stand->getTitle();
            $desc = $stand->getDesc();?>
            <div class="modal fade" id="<?php echo e("standAjout$id") ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body" style="height: 50rem">
                            <div class="h-75">
                                <div class="date">
                                    <div class="data-debut">
                                        <label for="start-date">Horaire de début :</label>
                                        <input type="datetime-local" id="start-date"
                                               name="meeting-time" value="2018-06-12T19:30"
                                               min="2018-06-07T00:00" max="2018-06-14T00:00">
                                    </div>
                                    <div class="data-fin">
                                        <label for="end-date">Horaire de fin:</label>
                                        <input type="datetime-local" id="end-date"
                                               name="meeting-time" value="2018-06-12T19:30"
                                               min="2018-06-07T00:00" max="2018-06-14T00:00">

                                    </div>
                                </div>
                                <h1>
                                    Choisissez le nombre d'élèves que vous voulez assigner à ce créneau :
                                </h1>
                                <div class="form-group col-md-4">
                                    <label for="inputNb">Nombres d'élèves</label>
                                    <select id="inputNb" class="form-control">
                                        <option selected>...</option>
                                        <?php
                                        for ($i = 1; $i <= 30; $i++) {
                                            echo "<option>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <h1>
                                    Choisissez le niveau recommandé des élèves que vous voulez assigner à ce créneau :
                                </h1>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="buttonStandAjout<?php echo e("$id")?>" class="btn btn-secondary">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
