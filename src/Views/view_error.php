<?php
    include 'view_topbar.php';
?>

    <div class="container text-center">
    <?php if (isset($message) && isset($title) && isset($code)): ?>
        <div class="alert alert-danger position-relative" role="alert">
            <h4 class="alert-heading"><?= $title ?></h4>
            <h5><?= $code ?></h5>
            <p><?= $message ?></p>
        </div>
    <?php endif; ?>
    </div>


<?php
    include 'view_footer.php';
?>