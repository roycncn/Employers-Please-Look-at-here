<div class="content">
    <h1>Your profile</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div>
        Your Adminname: <?php echo Session::get('adminName'); ?>
    </div>
    <div>
        Your User Id: <?php echo Session::get('adminid'); ?>
    </div>

</div>
