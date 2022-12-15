<?php
include "view_topbar.php";
?>

<style>
    body {
        background: url("public/images/Animath.jpg") no-repeat fixed center center;
    }
</style>

<div class="w-100" style="height: 93%"></div>


<div class="card bg-light" style="height: 7%">
    <div class="row text-center fs-5 h-100">
       <span class="col-6 border-end pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span>Connexion</span>
        </span>
        <span class="col-6 border-start pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <span>Inscription</span>
        </span>
    </div>
</div>

<div class="accordion shadow" id="accordionExample">
    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseOne" data-bs-parent="#accordionExample">
        <?php if(isset($_SESSION['user'])): ?>
        <div class="container text-center pt-3 pb-3 mt-3 mb-3">
            Vous êtes déja connécté : )
        </div>
        <?php else: ?>
        <form class="container needs-validation" method="post" action="?controller=User&action=sign_in" style="width: 35%" novalidate>
            <?php include "Layouts/connexion.php"?>
        </form>
        <?php endif; ?>
    </div>
    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseTwo" data-bs-parent="#accordionExample">
        <form class="container needs-validation" method="post" action="?controller=User&action=sign_up" style="width: 35%" novalidate>
            <?php include "Layouts/inscriptionCollapse.php"?>
        </form>
    </div>
</div>

<div class="container border shadow p-5 text-center bg-white">
    <div class="row gap-3">
        <div class="col-1"></div>
        <div class="card col-3 text-center">
            <div class="card-header">
                <img src="public/images/modif.png" alt="" class="card-img-top">
            </div>
            <div class="card-body">
                <h3>Titre</h3>
                <p class="card-text">Description</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary">Voir les disponibilités</a>
            </div>
        </div>
        <div class="card col-3 text-center">
            <div class="card-header">
                <img src="public/images/modif.png" alt="" class="card-img-top">
            </div>
            <div class="card-body">
                <h3>Titre</h3>
                <p class="card-text">Description</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary">Voir les disponibilités</a>
            </div>
        </div>
        <div class="card col-3 text-center">
            <div class="card-header">
                <img src="public/images/modif.png" alt="" class="card-img-top">
            </div>
            <div class="card-body">
                <h3>Titre</h3>
                <p class="card-text">Description</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary">Voir les disponibilités</a>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<?php
include "view_footer.php";
?>


