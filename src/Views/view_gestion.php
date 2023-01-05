<?php
include_once "view_topbar.php";
?>
<style>
    body {
        background: url("public/images/AnimathBlur.png") no-repeat fixed center center;
    }
</style>
<script src="public/js/fullcalendar-6.0.0/dist/index.global.js">
</script>

<div class="border-bottom mt-3 mb-3">
    <div class="container pt-3 pb-3 text-center">
        <div class="row">
            <div class="col-12">
                <h1>Gestion</h1>
            </div>
        </div>
    </div>
</div>
<div class="border">
<?php
$req = DatabaseModel::getModel()->getBD()->prepare('select * from Stand') ;
$req->execute();
$stands = $req->fetchAll(PDO::FETCH_ASSOC);
foreach ($stands as $stand):?>
    <div>bonjour</div>
    <?php foreach ($stand as $key => $value):?>
        <div>aurevoir</div>
    <?php endforeach; ?>
    <div>rebonjour</div>
<?php endforeach; ?>
</div>
<?php
include_once "view_footer.php";
?>
