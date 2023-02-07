<?php
include 'view_topbar.php';
include 'Layouts/modifierProf.php'
?>

<style>
    body {
        background: url("public/images/main-logo2-blur.png") no-repeat fixed center center;
        background-color: rgba(1,158,227,0.60);

    }

</style>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>
<div style="height:9%">
</div>
<div class="border-top border-bottom mt-3 mb-3 mx-auto mr- bg-light" style="width:69%">
    <div class="container pt-3 pb-2 text-center" >
        <div class="row">
            <div class="col-12">
                <h3>Mon compte</h3>
            </div>
        </div>
    </div>
</div>

<div class="container shadow border text-center bg-light" style="width:69%">
    <ul class="nav nav-justified gap-3 p-1 border-bottom">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#accordionInfoPerso" type="button" role="tab" aria-controls="accordionInfoPerso" aria-selected="true">Paramètres</a>
        </li>
        <?php if($user->getRole() === Role::PROFESSOR): ?>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="true">Réserver</a>
        </li>
        <?php endif; ?>
        <?php if($user->getRole() === Role::PROFESSOR): ?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#myvisits" type="button" role="tab" aria-controls="planning" aria-selected="true">Mes visites</a>
            </li>
        <?php endif; ?>
    </ul>


<div class="tab-content">
    <div class="tab-pane fade accordion m-3" id="accordionInfoPerso">
        <?php include "Layouts/personalData.php"; ?>
    </div>
    <div class="tab-pane h-50 show active fade m-3" id="booking">
        <?php include "Layouts/booking.php"?>
    </div>
    <div class="tab-pane fade m-3" id="myvisits">
        <?php include "Layouts/my_visits.php"?>
    </div>
</div>

<div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter evenement</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-floating">
                    <input class="form-control" type="text" id="title" placeholder="">
                    <label class="form-label" for="title"></label>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Ajouter"/>
            </div>
        </div>
    </div>
</div>
