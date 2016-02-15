<div class="content">
    <h1>Dashboard</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>


    <?php if (Session::get('user_logged_in') == true): ?>
        <h3>This is an area that's only visible for logged in Normal users</h3>

        <a href="<?php echo URL; ?>order/index">Order Manager</a>






    <?php endif; ?>

    <?php if (Session::get('admin_logged_in') == true): ?>
        <h3>This is an area that's only visible for logged in Admin users</h3>

            <p>I am an Administrator</p>








    <?php endif; ?>


</div>
