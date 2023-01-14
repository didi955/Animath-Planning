<?php
include_once "view_topbar.php";
?>
<style>
    body {
        background: url("public/images/main-logo2-blur.png") no-repeat fixed center center;
    }
</style>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>

<div class="border-top border-bottom mt-3 mb-3">
    <div class="container pt-3 pb-3 text-center">
        <div class="row">
            <div class="col-12">
                <h1>Gestion</h1>
            </div>
        </div>
    </div>
</div>


<div class="container shadow border text-center">
    <ul class="nav nav-justified gap-3 p-1">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#InfoPerso" type="button" role="tab" aria-controls="InfoPerso" aria-selected="true">Paramètres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#gestionStand" type="button" role="tab" aria-controls="gestionStand" aria-selected="true">Gestion des stands</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show" id="InfoPerso">

        </div>
        <div  class="tab-pane fade" id="gestionStand">
            <?php include_once "Layouts/supervisor/gestionStand.php"?>
        </div>

    </div>
</div>

