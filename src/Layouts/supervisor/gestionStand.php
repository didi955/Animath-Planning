<div class="p-5 container">
    <div class="ps-5 ms-5 row gap-5">
        <?php foreach ($stands as $stand):
            $id = $stand->getId();
            $title = $stand->getTitle();
            $desc = $stand->getDesc();
            $activities = $stand->getActivities();?>
            <div class="modal fade" id="<?php echo e("standAjout$id") ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="form" action="?controller=Activities&action=create" method="post">
                                <input type="hidden" name="id" value="<?php echo e($id)?>">
                                <div>
                                    <label for="debut">Date de début</label>
                                    <input type="datetime-local" id="debut" name="debut">
                                </div>
                                <div>
                                    <label for="fin">Date de Fin</label>
                                    <input type="datetime-local" id="fin" name="fin">
                                </div>
                                <div>
                                    <label for="niveau">Niveau des élèves</label>
                                    <input type="checkbox" id="niveau" name="niveau" value="Primaire">Primaire
                                    <input type="checkbox" id="niveau" name="niveau" value="College">Collège
                                    <input type="checkbox" id="niveau" name="niveau" value="Lycee">Lycée
                                </div>
                                <div>
                                    <label for="capacity">Capacité d'élève</label>
                                    <input type="number" id="capacity" name="capacity">
                                </div>
                                <input type="submit" value="Envoyer">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="<?php echo e("standCalendar$id") ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body" style="height: 50rem">
                            <div class="h-75" id="calendar<?php echo e("$id") ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" href="<?php echo e("#standAjout$id")?>" data-bs-toggle="modal">Ajouter</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
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
                        editable: false,
                        snapDuration: '00:15:00',
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
                            },
                            <?php endforeach;?>
                        ]
                    });
                    calendar.render();
                });
            </script>
        <?php endforeach; ?>
    </div>
</div>
