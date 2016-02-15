<div class="content">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box">
        <h1>Login</h1>
        <form action="<?php echo URL; ?>admin/login" method="post">
            <label>Adminid</label>
            <input type="text" name="adminid" required />
            <label>Password</label>
            <input type="password" name="password" required />
            <input type="submit" class="login-submit-button" />
        </form>

    </div>

</div>
