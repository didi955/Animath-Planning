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
                <a class="btn btn-primary btn-lg" href="?controller=User&action=my_account">Mon compte</a>
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
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porta pulvinar accumsan. Praesent sollicitudin dolor vel quam elementum, eget faucibus urna vulputate. Vestibulum luctus magna eget auctor venenatis. Nam volutpat velit ac nulla scelerisque rhoncus. Suspendisse ante urna, laoreet consectetur magna at, egestas dignissim neque. Cras condimentum consequat dictum. Aliquam venenatis sollicitudin augue ac euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis ullamcorper quis lorem ac ullamcorper. Suspendisse varius, lorem ut lobortis venenatis, dui quam imperdiet neque, at fringilla ligula risus vitae elit. Phasellus laoreet id lacus eget scelerisque.

                    Fusce dignissim nunc nec purus pretium, nec hendrerit ex ultrices. Quisque finibus molestie mauris, eget elementum lorem sagittis non. Duis mollis rutrum massa, quis bibendum turpis vulputate in. Nunc id orci et enim efficitur rutrum id a lorem. Donec vel turpis in felis efficitur consequat sed sit amet diam. Curabitur vel neque non ipsum accumsan tempus non at magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin blandit lacus sit amet erat condimentum lacinia. Praesent vehicula libero et tellus egestas semper. Etiam at fringilla velit. Donec non sapien ac diam ornare consectetur. Cras laoreet sagittis tortor, sit amet maximus nisl facilisis vitae. Nulla a mi purus.

                    Proin posuere ullamcorper leo a pharetra. Ut ut lorem lorem. Curabitur sodales, dui nec tincidunt condimentum, felis augue dignissim dolor, at commodo velit lorem eget massa. Morbi et odio placerat, facilisis turpis sed, mollis nisl. Curabitur faucibus orci vulputate orci pellentesque placerat. In id nisl sed arcu tristique sagittis non scelerisque tellus. Vestibulum nec efficitur turpis, vel lacinia massa. Cras odio mauris, mollis ac felis non, varius gravida neque. Vivamus imperdiet tempor augue in feugiat. Phasellus diam magna, fermentum nec ornare sit amet, luctus sit amet nisl. Donec mattis libero nisl, at viverra ante egestas eu. Vestibulum vel tortor cursus, ornare risus sit amet, tempor sapien. Quisque eget augue fringilla, gravida purus vel, vulputate lectus.
                </div>
            </div>
        </div>
    </div>
</div>

