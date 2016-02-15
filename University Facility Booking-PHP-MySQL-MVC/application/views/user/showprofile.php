<div class="content">
    <h1>Your profile</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div>
        Your name: <?php echo Session::get('sname'); ?>
    </div>
    <div>
        Your SSo Id: <?php echo Session::get('ssoid'); ?>
    </div>

</div>
