<?php
include 'view_topbar.php';
?>

    <div class="container text-center">
    <div class="row">
        <div class="col-12">
            <h1>Mon compte</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Informations personnelles</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p>Adresse mail : <?= e($user->getEmail()) ?></p>
            <p>Nom : <?= e($user->getLastName()) ?></p>
            <p>Prénom : <?= e($user->getFirstName()) ?></p>
            <p>Role : <?= e($user->getRole()->name) ?></p>
        </div>
    </div>

<?php
include 'view_footer.php';
?>