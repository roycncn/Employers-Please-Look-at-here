<div class="content" align="center">
    <h1>Overview</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        This page is Print the User List. Just For Demo. 
    </p>

    <p>

    <table class="overview-table">
        <?php
        foreach ($this->users as $user) {

            echo '<td>' . $user->ssoid . '</td>';
            echo '</td>';
            echo '<td>' . $user->sname . '</td>';
            echo '<td><a href="' . URL . 'overview/showuserprofile/' . $user->ssoid . '">Show user\'s profile</a></td>';
            echo "</tr>";
        }
        ?>
    </table>
    <h3>------------------------</h3>

    <table class="overview-table">
        <?php
        foreach ($this->admin as $admin) {

            echo '<td>' . $admin->adminid . '</td>';
            echo '</td>';
            echo '<td>' . $admin->adminName . '</td>';
            echo '<td><a href="' . URL . 'overview/showadminprofile/' . $admin->adminid . '">Show admin\'s profile</a></td>';
            echo "</tr>";
        }
        ?>
    </table>
</p>
</div>
