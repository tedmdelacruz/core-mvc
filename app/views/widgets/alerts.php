<?php

$flashSuccess = Session::getFlashData('success');
$flashError = Session::getFlashData('error');

?>

<?php if( isset($error) and $error): ?>

    <div class="alert alert-error">
        <?php echo $error ?>
    </div>

<?php endif ?>

<?php if( isset($success) and $success): ?>

    <div class="alert alert-success">
        <?php echo $success ?>
    </div>

<?php endif ?>

<?php if( ! empty($flashSuccess ) ): ?>

    <div class="alert alert-success">
        <?php echo $flashSuccess ?>
    </div>

<?php endif ?>