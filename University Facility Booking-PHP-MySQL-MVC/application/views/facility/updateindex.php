<div class="content" align="center">
    <h1>Update</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        Please choose a facility to update
    </p>

    <form action="<?php echo URL; ?>facility/updateindex" method="post">   
        <table class="overview-table">


            <tr> <th></th><th>Facility ID</th><th>Name</th><th>Type</th><th>Location</th><th>Num Of User</th></tr>
            <?php
            foreach ($this->facility as $facility) {
                ?><tr><td><input type="radio" name="facility" value="<?php echo "$facility->fid"; ?>" /></td>
                                                        <?php
                                                        echo '<td>' . $facility->fid . '</td>';
                                                        echo '<td>' . $facility->fname . '</td>';
                                                        echo '<td>' . $facility->type . '</td>';
                                                        echo '<td>' . $facility->location . '</td>';
                                                        echo '<td>' . $facility->numOfUser . '</td></tr>';

                                                    }
                                                    ?>
        </table>
        <input type="submit" value="Submit"/>
    </form>
</div>

