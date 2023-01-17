<?php
include_once "view_topbar.php";
?>
<style>
    body {
        background: url("public/images/main-logo2-blur.png") no-repeat fixed center center;
        background-color: rgba(1,158,227,0.60);
    }

</style>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>

<div style="height:9%"></div>


<div class="border-top border-bottom mt-3 mb-3 mx-auto mr- bg-light" style="width:69%">
    <div class="container pt-3 pb-2 text-center" >
        <div class="row">
            <div class="col-12">
                <h3>Gestion</h3>
            </div>
        </div>
    </div>
</div>


<div class="container shadow border text-center bg-light">
    <ul class="border-bottom nav nav-justified gap-3 p-1">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#InfoPerso" type="button" role="tab" aria-controls="InfoPerso" aria-selected="false">Paramètres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#gestionStand" type="button" role="tab" aria-controls="gestionStand" aria-selected="true">Gestion des stands</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#gestionAdmin" type="button" role="tab" aria-controls="gestionAdmin" aria-selected="false">Gestion Admin</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="InfoPerso">
        </div>
        <div class="tab-pane fade" id="gestionStand">
            <?php include "Layouts/supervisor/gestionStand.php"?>
        </div>
        <div class="tab-pane fade" id="gestionAdmin">
            <?php $superviseurs = ['superviseur 1', 'superviseur 2', 'superviseur 3' , 'superviseur 4' , 'superviseur 5',
            'superviseur 6']?>
            <table class="table">

            <?php foreach($superviseurs as $superviseur):?>
                <tr>
                    <td>
                        <?=e($superviseur)?>
                        <div class="d-flex justify-content-end ">
                        <button class="btn btn-danger ">Supprimer</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </table>
            <br>
            <div class="d-flex justify-content-end">
            <input class="btn btn-primary " type="submit" value="Ajouter Superviseur">
            </div>
        </div>
    </div>
</div>

