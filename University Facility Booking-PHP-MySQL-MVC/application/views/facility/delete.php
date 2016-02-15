<div class="content" align="center">
    <h1>Delete</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        Please choose a Facility to Delete
    </p>

    <form action="<?php echo URL; ?>facility/delete" method="post">   
        <table class="overview-table">


            <tr> <th></th><th>Facility ID</th><th>Name</th><th>Type</th><th>Location</th><th>Num Of User</th></tr>
            <?php
            foreach ($this->facility as $facility) {
                ?><tr><td><input type="radio" name="fid" value="<?php echo "$facility->fid"; ?>" /></td>
                                                        <?php
                                                        echo '<td>' . $facility->fid . '</td>';
                                                        echo '<td>' . $facility->fname . '</td>';
                                                        echo '<td>' . $facility->type . '</td>';
                                                        echo '<td>' . $facility->location . '</td>';
                                                        echo '<td>' . $facility->numOfUser . '</td>';

                                                    }
                                                    ?>
        </table>
        <input type="submit" value="Submit"/>
    </form>
</div>

