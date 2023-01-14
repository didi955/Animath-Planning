<?php
include "view_topbar.php";
?>

<style>
    body {
        background: url("public/images/main-logo2-blur.png") no-repeat fixed center center;
        background-color: rgba(1,158,227,0.60);
    }

</style>

<div style="height:9%">
</div>
<div class="border-top border-bottom mt-3 mb-3 mx-auto mr- bg-light" style="width:69%">
    <div class="container pt-3 pb-2 text-center" >
        <div class="row">
            <div class="col-12">
                <h3>Exposition</h3>
            </div>
        </div>
    </div>
</div>

<div class="container bg-light">
    <div class="p-3 d-flex justify-content-center">
        <select class="text-center w-50 form-select" aria-label="Default select example">
            <option selected>--Choisissez un stand--</option>
            <?php foreach($stands as $stand):?>
                <option value="<?php echo e($stand->getTitle()) ?>"><?php echo e($stand->getTitle()) ?></option>
            <?php endforeach;?>
        </select>
    </div>
</div>
