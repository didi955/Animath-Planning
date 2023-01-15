<?php
include "view_topbar.php";
?>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>
<style>
    body {
        background: url("public/images/main-logo2-blur.png") no-repeat fixed center center;
        background-color: rgba(1,158,227,0.60);
    }

</style>

<div style="height:9%">
</div>
<div class="border-top border-bottom mt-3 mb-3 mx-auto mr- bg-light" style="width:69%">
    <div class="container pt-3 pb-2 text-center" >
        <div class="row">
            <div class="col-12">
                <h3>Exposition</h3>
            </div>
        </div>
    </div>
</div>

<div class="container bg-light">
    <div class="p-3 d-flex justify-content-center">
        <select class="text-center w-50 form-select" aria-label="Default select example">
            <option selected>--Choisissez un stand--</option>
            <?php foreach($stands as $stand):?>
                <option value="<?php echo e($stand->getId()) ?>"><?php echo e($stand->getTitle()) ?></option>
            <?php endforeach;?>

        </select>
    </div>
</div>
<div class="tab-content">
    <?php foreach($stands as $stand):
        $activities = $stand->getActivities();
        $id = $stand->getId();
        $title = $stand->getTitle();
        ?>


    <div class="tab-pane fade  accordion m-3" id="accordionStand<?php echo e($id)?>">
        <div class="h-100" id="calendar<?php echo e("$id") ?>">
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

    <?php endforeach;?>
</div>






