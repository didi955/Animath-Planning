<div class="p-5 container">
    <div class="ps-5 ms-5 row gap-5">
        <?php if(isset($err)):?>
        <div class="alert alert-danger" role="alert">
            <?php echo e($err) ?>
        </div>
        <?php endif;?>
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
                            <div class="h-100" id="calendar<?php echo e("$id") ?>">
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
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
                        themeSystem: 'bootstrap5',
                        initialDate: '2023-05-25',
                        initialView: 'timeGridDay',
                        locale: 'fr',
                        editable: false,
                        snapDuration: '00:15:00',
                        allDaySlot: false,
                        slotMinTime: '09:00:00',
                        slotMaxTime: '18:15:00',
                        slotDuration: '00:15:00',
                        eventClick: function (info){
                            let modal = document.getElementById("suppr"+info.event.id);
                            modal.classList.add("show")
                            modal.style.display = "block";
                        },
                        events: [
                            <?php foreach ($activities as $activity):
                            $start = $activity->getStart();
                            $end = $activity->getEnd();
                            $capacity = $activity->getCapacity();
                            $student_level = $activity->getStudentLevel();
                            $idact = $activity->getId();
                            ?>
                            {
                                id: <?php echo e($idact) ?>,
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
            <?php foreach ($activities as $activity):
            $start = $activity->getStart();
            $end = $activity->getEnd();
            $idact = $activity->getId();
            ?>
                <div class="modal fade" id="suppr<?php echo("$idact") ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="?controller=Activities&action=remove">
                                <input type="hidden" name="id" value="<?php echo e($idact)?>">
                                <label for="sub">Voulez vous supprimez cette activité ?</label>
                                <input class="btn btn-primary" type="submit" value="Oui" id="suboui">
                                <button type="button" class="btn btn-secondary" onclick="function dismiss(){
                                    let modal = document.getElementById('suppr'+<?php echo e("$idact")?>);
                                        modal.classList.remove('show');
                                        modal.style.display = 'none';
                                        } dismiss();"
                                >Non</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <div class="w-100 mt-3 pt-3 border-top">
        <a class="btn btn-primary" href="?controller=Activities&action=generate">Generer les stands</a>
    </div>
</div>
