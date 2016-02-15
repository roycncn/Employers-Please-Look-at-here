<div class="content" align="center">
    <h1>Order Detial</h1>


    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if ($this->order) { ?>
    <p>
        <table class="overview-table">
            <tr><td>Order Id:</td><td><?php echo $this->order[0]->orderID; ?></td></tr>
            <tr><td>SSoid:</td><td><?php echo $this->order[0]->ssoid; ?></td></tr>
            <tr><td>Facility:</td><td><?php echo $this->order[0]->fname; ?></td></tr>
            <tr><td>Book Time:</td><td><?php echo $this->order[0]->bookTime; ?></td></tr>
            <tr><td>Purpose:</td><td><?php echo $this->order[0]->purpose; ?></td></tr>
            <tr><td>Price:</td><td><?php echo $this->order[0]->price; ?></td></tr>
            <tr><td>Date:</td><td><?php echo $this->order[0]->useDate; ?></td></tr>
            <tr><td>Start Time:</td><td><?php echo $this->order[0]->starttime; ?>:00</td></tr>
            <tr><td>End Time:</td><td><?php echo $this->order[0]->endtime; ?>:00</td></tr>
            <tr><td>Is Withdraw:</td><td><?php if($this->order[0]->isWithdraw){ echo "YES";} else {echo "NO";} ?></td></tr>
        </table>
    </p>
<?php } ?>
</div>
