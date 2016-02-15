<div class="content" align="center">
    <h1>A public user profile</h1>
    <p>This view shows all public information about a certain user.</p>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if ($this->admin) { ?>
        <p>
            <span style="color: red;">This is just a demo.</span>
        <table class="overview-table">
            <?php
            echo '<td>' . $this->admin->adminid . '</td>';
            echo '<td>' . $this->admin->adminName . '</td>';
            echo "</tr>";
            ?>
        </table>
    </p>
<?php } ?>
</div>
