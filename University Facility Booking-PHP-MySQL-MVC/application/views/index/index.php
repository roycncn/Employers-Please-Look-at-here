<div class="content">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box">
        <h1>Login</h1>
        <form action="<?php echo URL; ?>user/login" method="post">
            SSOid:
            <input type="text" name="ssoid" required />
            Password:
            <input type="password" name="password" required />
            <input type="submit" class="login-submit-button" />
        </form>
        <a href="<?php echo URL; ?>admin/index">Admin Login</a>




    </div>

</div>
