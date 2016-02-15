<div class="content" align="center">
    <h1>Order Manager</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        You can Check your order here.
    </p>

    <p>

    <table class="overview-table">
            <tr><th>Order Id</th><th>SSOid</th><th>Facility</th><th>Order Time</th><th>isWithdraw</th><th></th><th></th></tr>
        <?php
        foreach ($this->order as $order) {
            echo '<tr>';
            echo '<td>' . $order->orderId . '</td>';
            echo '<td>' . $order->ssoid . '</td>';
            echo '<td>' . $order->fname . '</td>';
            echo '<td>' . $order->bookTime . '</td>';
            echo '<td>' . $order->isWithdraw . '</td>';
            echo '<td><a href="' . URL . 'order/showorder/' . $order->orderId . '">Show order\'s detail</a></td>';
            echo '<td><a href="' . URL . 'order/withdraw/' . $order->orderId . '">Withdraw Order</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</p>
</div>
