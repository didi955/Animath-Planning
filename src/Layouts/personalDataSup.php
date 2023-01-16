<div class="accordion-item">
    <h2 class="accordion-header" id="HeaderPanelInfo">
        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#PanelInfo" aria-expanded="true" aria-controls="PanelInfo">
            Informations personnelles
        </button>
    </h2>
    <?php if($user->getRole() === Role::SUPERVISOR):?>

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
                        <img class="w-25" type="button" data-bs-toggle="modal" href="#emailModal" src="public/images/modif.png" alt="modif">
                    </div>
                </div>
            </div>
</div>
<div class="accordion-item">
    <h2 class="accordion-header" id="HeaderPanelSecurity">
        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#PanelSecurity" aria-expanded="true" aria-controls="PanelRole">
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
    </div>
    <?php endif;?>
</div>
