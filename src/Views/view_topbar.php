<nav class="fixed-top d-flex mb-3 navbar bg-body-tertiary bg-light border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://salon-math.fr/" target="_blank">
            <img src="public/images/logo-bleu.png" alt="Bootstrap" width="110" height="50">
        </a>
        <a class="btn btn-primary me-3" href="index.php" role="button">Accueil</a>
        <a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target= "#cguModalHome">CGU</a>
        <a class="ms-auto p-3 nav-item" role="button" aria-expanded="true" aria-controls="collapseMenu" data-bs-toggle="collapse" data-bs-target="#collapseMenu" alt="mon_compte" >
            <svg width="30" height="30" fill="blue" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8ZM6 8a6 6 0 1 1 12 0A6 6 0 0 1 6 8Zm2 10a3 3 0 0 0-3 3 1 1 0 1 1-2 0 5 5 0 0 1 5-5h8a5 5 0 0 1 5 5 1 1 0 0 1-2 0 3 3 0 0 0-3-3H8Z"></path>
            </svg>
        </a>
    </div>
</nav>

<div class="modal fade" id="cguModalHome" tabindex="-1" aria-labelledby="cguModalLabel" aria-hidden="true">
    <?php
    include_once "view_legal.php";
    ?>
</div>

<div class="collapse position-absolute" id="collapseMenu" style="width: 13%; margin-left: 86%; margin-top: 5%">
    <div class="card card-body">
        <?php if(isset($_SESSION['user'])): ?>
            <?php if(unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR): ?>
                <a class="btn btn-primary btn-lg" href="?controller=User&action=gestion">Gestion</a>
            <?php else: ?>
                <a class="btn btn-primary btn-lg" href="?controller=User&action=my_account">Mon compte</a>
            <?php endif; ?>
            <a class="btn btn-outline-danger btn-sm mb-1 ms-3 me-3 mt-3" href="?controller=User&action=sign_out">Se déconnecter</a>
        <?php else : ?>
        <p class="text-center">Vous n'êtes pas connecté !</p>
        <span class="row">
                <button class="col border-right btn btn-light border m-1" data-bs-toggle="modal" href="#connexionModal">Connexion</button>
                <button class="col border-left btn btn-primary border m-1" data-bs-toggle="modal" href="#inscriptionModal">Inscription</button>
            <?php endif; ?>
        </span>
    </div>
</div>




<div class="modal fade" id="connexionModal" tabindex="-1" aria-labelledby="connexionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="container needs-validation" method="post" action="?controller=User&action=sign_in" novalidate>
                    <?php include "Layouts/connexion.php"?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inscriptionModal" tabindex="-1" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="container needs-validation" method="post" action="?controller=User&action=sign_up" novalidate>
                    <?php include "Layouts/inscriptionModal.php"?>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cguModalTopbar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="cguModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?=e(CGU_TITLE)?></h1>
                <button type="button" class="btn-close" data-bs-target="#inscriptionModal" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-dialog modal-dialog-scrollable">
                    <?php include "Layouts/legal.php"?>
                </div>
            </div>
        </div>
    </div>
</div>