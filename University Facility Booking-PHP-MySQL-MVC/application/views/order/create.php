<div class="content">

    <style>
    table,th,tr,td{
        border: 0px;
    }
    td{
        vertical-align:middle;
    }

    </style>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="cre" align="center">
        <h1>New Order</h1>

        <form action="<?php echo URL; ?>order/create" method="post">
        <table>
            <input type="hidden" name="ssoid" value="<?php echo Session::get('ssoid'); ?>" />
            <input type="hidden" name="fid" value="<?php echo $this->order['fid'];?>" />
            <input type="hidden" name="bookTime" value="<?php echo date("Y-m-d H:m:s"); ?>" />
        <tr>   
            <td>Facility:</td>
            <td><input type="text" name="fname" value="<?php echo $this->order['fname'];?>" readonly/></td>                
        </tr>

        <tr>   
            <td>Tel:</td>
            <td><input type="text" name="phoneNumber" onchange="if(/\D/.test(this.value)){alert('Number Only');this.value='<?php echo $this->order['minuser'];?>';}" required /></td>                
        </tr>
        <tr>   
            <td>Purpose:</td>
            <td><input type="text" name="purpose" required /></td>                
        </tr>
        <tr>   
            <td>Price:</td>
            <td><input type="text" name="price"  value="<?php echo ($this->order['price']) ?>" readonly/></td>    
        </tr>
        <tr>   
            <td>User Number:</td>
            <td><input type="text" name="numOfUser" onchange="if(/\D/.test(this.value)){alert('Number Only');this.value='<?php echo $this->order['minuser'];?>';}
                if(parseInt(this.value)<parseInt('<?php echo $this->order['minuser'];?>')){alert('Not Enough Users');this.value='<?php echo $this->order['minuser'];?>';}" value="<?php echo $this->order['minuser']; ?>" required /></td>           
        </tr>
        
        <tr>   
            <td>Date:</td>
            <td><input type="text" name="useDate" value="<?php echo $this->order['date'];?>" readonly/></td>
        </tr>
 
        <tr>   
            <td>StartTime:</td>
            <td><input type="text" name="startTime" value="<?php echo $this->order['starttime'];?>:00" readonly/></td>
        </tr>

        <tr>   
            <td>EndTime:</td>
            <td><input type="text" name="endTime" value="<?php echo $this->order['endtime'];?>:00" readonly/></td>
        </tr>


        </table>
            <input type="submit" class="login-submit-button" />


        </form>







    </div>

</div>

