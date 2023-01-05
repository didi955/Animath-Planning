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
$req = DatabaseModel::getModel()->getBD()->prepare('select * from stand') ;
$req->execute();
$stands = $req->fetchAll(PDO::FETCH_ASSOC);
foreach ($stands as $stand) {
    echo "<div class='card'><div class='card-header'>$stand[title]</div><div class>";
    foreach ($stand as $key => $value) {
        echo "<div>$key: $value</div>";
    }
    echo "</div><div class='card-footer'></div></div>";
}
?>
</div>
<?php
include_once "view_footer.php";
?>
