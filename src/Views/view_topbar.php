<div class="fixed-top">
  <div class="row align-items-center fixed-top position-absolute mt-2" style="width: 15%;left:85%;height: 10%">
      <a class="col text-center" href="index.php">Accueil</a>
      <!--<span class="col w-50 form-check-reverse form-switch text-center">
      <label for="darkMode"></label><input class="mx-1 form-check-input " type="checkbox" id="darkMode" role="switch">
      </span>
      -->
    <span class="col w-50">
        <img class="w-75 btn" style="min-width: 80px" data-bs-toggle="collapse" data-bs-target="#collapseMenu" role="button" aria-expanded="true" aria-controls="collapseMenu" src="public/images/avatar.png" alt="mon_compte">
    </span>
    <div class="collapse" id="collapseMenu">
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

