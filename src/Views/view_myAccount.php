<?php
include 'view_topbar.php';
?>

<?php
    if(isset($_SESSION['uuid']) || isset($_COOKIE['uuid'])){
        $user = UserModel::getModel()->getUser($_SESSION['uuid'] ?? $_COOKIE['uuid']);
        if($user != null): ?>
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
                        <p>Adresse mail : <?= $user->getEmail() ?></p>
                        <p>Nom : <?= $user->getLastName() ?></p>
                        <p>Prénom : <?= $user->getFirstName() ?></p>
                        <p>Role : <?= $user->getRole()->name ?></p>
                    </div>
                </div>
        <?php endif;
    }
?>

<?php
include 'view_footer.php';
?>