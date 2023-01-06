<?php
include_once "view_topbar.php";
?>
<?php
$req = DatabaseModel::getModel()->getBD()->prepare('select * from "Stand"') ;
$req->execute();
$stands = $req->fetchAll(PDO::FETCH_ASSOC);
$i = 0?>
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
<div>

</div>
<div class="ps-5 container">
    <div class="ps-5 ms-5 row gap-5">
        <?php foreach ($stands as $stand):?>
            <div class="card col-3" style="height: 15rem">
                <div class="card-header p-3">
                    <?php echo e("$stand[title]") ?>
                </div>
                <div class="card-body overflow-scroll p-3">
                    <?php echo e("$stand[desc]"); ?>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="<?php echo e("#standCalendar$stand[id]")?>" data-bs-toggle="modal">Gerer le planing</a>
                </div>
            </div>
            <div class="modal fade" id="<?php echo e("standCalendar$stand[id]") ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div id="calendar">
                                <?php echo e("standCalendar$stand[id]") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
include_once "view_footer.php";
?>
