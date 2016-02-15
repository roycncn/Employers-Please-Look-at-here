<div class="content" align="center">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box">
        <h1>Facility Manage</h1>
        <form action="<?php echo URL; ?>facility/index" method="post">   
                <input type="submit" value="Query Facility"  class="login-submit-button" />
        </form>
        <form action="<?php echo URL; ?>facility/create" method="post">   
                <input type="submit" value="Add Facility"  class="login-submit-button" />
        </form>
        <form action="<?php echo URL; ?>facility/updateindex" method="post">   
                <input type="submit" value="Update Facility"  class="login-submit-button" />
        </form>
        <form action="<?php echo URL; ?>facility/delete" method="post">   
                <input type="submit" value="Delete Facility"  class="login-submit-button" />
        </form>

    </div>

</div>
