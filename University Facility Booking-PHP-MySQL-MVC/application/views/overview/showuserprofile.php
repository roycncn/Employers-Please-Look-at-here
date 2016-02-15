<div class="content" align="center">
    <h1>A public user profile</h1>
    <p>This view shows all about a admin user.</p>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if ($this->user) { ?>
        <p>
            <span style="color: red;"> This is just a demo.</span>
        <table class="overview-table">
            <?php
            echo '<td>' . $this->user->ssoid . '</td>';
            echo '<td>' . $this->user->sname . '</td>';
            echo "</tr>";
            ?>
        </table>
    </p>
<?php } ?>
</div>
