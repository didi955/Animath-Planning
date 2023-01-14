<?php
    include 'view_topbar.php';
?>

    <div class="w-100" style="height: 12%"></div>

    <div class="container w-50 text-center">
    <?php if (isset($message) && isset($title)): ?>
        <div class="alert alert-danger position-relative" role="alert">
            <h4 class="alert-heading"><?= $title ?></h4>
            <p><?= $message ?></p>
        </div>
    <?php endif; ?>
    </div>

    <div class="w-100" style="height: 61%"></div>

