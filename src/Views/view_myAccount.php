<?php
include 'view_topbar.php';
include 'Layouts/modifierProf.php'
?>

<style>
    body {
        background: url("public/images/AnimathBlur.png") no-repeat fixed center center;
    }
</style>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>

<div class="border-top border-bottom mt-3 mb-3">
    <div class="container pt-3 pb-3 text-center">
        <div class="row">
            <div class="col-12">
                <h1>Mon compte</h1>
            </div>
        </div>
    </div>
</div>

<div class="container shadow border text-center">
    <ul class="nav nav-justified gap-3 p-1">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#accordionInfoPerso" type="button" role="tab" aria-controls="accordionInfoPerso" aria-selected="true">Paramètres</a>
        </li>
        <?php if($user->getRole() === Role::PROFESSOR): ?>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="true">Réserver</a>
        </li>
        <?php endif; ?>
        <?php if($user->getRole() !== Role::SUPERVISOR): ?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#planning" type="button" role="tab" aria-controls="planning" aria-selected="true">Mes visites</a>
            </li>
        <?php endif; ?>
    </ul>
<div class="tab-content">
    <div class="tab-pane fade show accordion m-3" id="accordionInfoPerso">
        <div class="accordion-item">
            <h2 class="accordion-header" id="HeaderPanelInfo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PanelInfo" aria-expanded="true" aria-controls="PanelInfo">
                    Informations personnelles
                </button>
            </h2>
            <?php if($user->getRole() === Role::PROFESSOR):?>

                <div id="PanelInfo" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelInfo">
                    <div class="accordion-body row">
                        <div class="col-1">
                            Mail :
                        </div>
                        <div class="col-10 text-center">
                            <strong> <?= e($user->getPersonalData()['email']) ?> </strong>
                        </div>
                        <div class="col-1">
                            <div class="h-50">
                                <img class="w-25" type="button" data-bs-toggle="modal" href="#emailModal" src="public/images/modif.png" alt="modif">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-body row">
                        <div class="col-1">
                            Nom :
                        </div>
                        <div class="col-10">
                            <strong><?= e($user->getPersonalData()['last_name']) ?></strong>
                        </div>
                        <div class="col-1">
                            <div class="h-50">
                                <img class="w-25" type="button" data-bs-toggle="modal" href="#nomModal" src="public/images/modif.png" alt="modif">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-body row">
                        <div class="col-1">
                            Prénom :
                        </div>
                        <div class="col-10">
                            <strong><?= e($user->getPersonalData()['first_name']) ?></strong>
                        </div>
                        <div class="col-1">
                            <div class="h-50">
                                <img class="w-25" type="button" data-bs-toggle="modal" href="#prenomModal" src="public/images/modif.png" alt="modif">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-body row">
                        <div class="col-1">
                            Téléphone :
                        </div>
                        <div class="col-10">
                            <?php if ($user->getPersonalData()['phone'] != null) : ?>
                                <strong><?= e($user->getPersonalData()['phone']) ?></strong>
                            <?php else : ?>
                                <strong>Non renseigné</strong>
                            <?php endif; ?>
                        </div>
                        <div class="col-1">
                            <div class="h-50">
                                <img class="w-25" type="button" data-bs-toggle="modal" href="#telephoneModal" src="public/images/modif.png" alt="modif">
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif($user->getRole() === Role::EXHIBITOR):?>

                <div id="PanelInfo" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelInfo">
                    <div class="accordion-body row">
                        <div class="col-1">
                            Mail :
                        </div>
                        <div class="col-10 text-center">
                            <strong> <?= e($user->getConnexionID()) ?> </strong>
                        </div>
                        <div class="col-1">
                            <div class="h-50">
                                <img class="w-25" src="public/images/modif.png" alt="modif">
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif;?>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="HeaderPanelSecurity">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PanelSecurity" aria-expanded="true" aria-controls="PanelRole">
                    Sécurité
                </button>
            </h2>
            <div id="PanelSecurity" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelSecurity">
                <div class="accordion-body row">
                    <div class="col-1">
                        Mot de passe :
                    </div>
                    <div class="col-10">
                        <strong><?= e("•••••••••••") ?></strong>
                    </div>
                    <div class="col-1">
                        <div class="h-50">
                            <img class="w-25" type="button" data-bs-toggle="modal" href="#MdpModal" src="public/images/modif.png" alt="modif">
                        </div>
                    </div>
                </div>
                <div class="accordion-body row">
                    <div class="col-1">
                        Role :
                    </div>
                    <div class="col-10">
                        <strong><?= e($user->getRole()->name) ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane h-50 fade m-3" id="booking">
        <?php include "Layouts/booking.php"?>
    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridDay',
            locale: 'fr',
            editable: true,
            allDaySlot: false,
            events: [
                {
                    title: 'Activité échecs',
                    start: '2022-12-16T15:00:00'
                }
            ]
        });
        calendar.render();
    });
</script>