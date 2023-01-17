<div>
    <div class="pb-4">
        <h4 class="pb-1">Mes visites pour le jeudi 25/05/2023</h4>

        <?php if(isset($appointements )): ?>
        <?php foreach ($appointements as $app): ?>
            <div class="card mb-3">
                <div class="card-header p-1">
                    <p><?=e($app['title'])?></p>
                </div>
                <div class="card-body p-1"
                <p>Horaire de début: <?=e($app['start'])?></p>
                <p>Horaire de fin: <?=e($app['end'])?></p>
            </div>
            <div class="card-footer p-1">
                <button class="btn btn-danger" href="<?php echo e("#deleteActivities" . $app['id_activity'])?>" data-bs-toggle="modal">Supprimer</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Détails</button>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>


            <h4 class="pb-1">Mes visites pour le Vendredi 26/05/2023</h4>

    </div>

</div>