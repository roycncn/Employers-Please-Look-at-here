<div class="content" align="center">
    <style>
    td{
        vertical-align:middle;
    }

    </style>
<script type="text/javascript">
function check(){

        st=document.getElementById("startTime").value;
        et=document.getElementById("endTime").value;

                if(parseInt(st)>=parseInt(et)){
                    alert('Wrong Time!');
                    window.event.returnValue=false;
                }

    }
</script>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box" align="center">
        <h1>Add New Facility</h1>

        <form action="<?php echo URL; ?>facility/create" method="post">   
            <table class="new-facility">
                <tr>
                    <td>Facility Name:</td>
                    <td><input type="text" name="fname" required /></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><select name="type">
                            <option value="Sports">Sports</option>
                            <option value="Studying Room">Studying Room</option>
                            <option value="Classroom">Classroom</option></select>
                    </td>
                </tr>
                <tr> <td>Location:</td>
                    <td><select name="location">
                            <option value="AAB">AAB</option>
                            <option value="mhall">Main Hall</option>
                            <option value="SCC">SCC</option></select></td>
                </tr>
                <tr>
                    <td>Minimum Number Of User:</td>
                    <td><input type="text" name="numOfUser" onchange="if(/\D/.test(this.value)){alert('Number Only');this.value='';}" required /></td>
                </tr>
                <tr>
                    <td>Price(per hour):</td>
                    <td><input type="text" name="price" onchange="if(/\D/.test(this.value)){alert('Number Only');this.value='0';}" value='0' required/></td>
                </tr>
                <tr> 
                    <td>Start Time:</td>
                    <td><select name="startTime" id="startTime">
                            <?php
                            for ($i = 9; $i < 21; $i++) {
                                echo "<option value=\"$i\">$i:00</option>";
                            }
                            ?></select></td>
                </tr>
                <tr>
                    <td> End Time:</td>
                    <td><select name="endTime" id="endTime"> 
                            <?php
                            for ($i = 10; $i < 22; $i++) {
                                echo "<option value=\"$i\">$i:00</option>";
                            }
                            ?></select>
                            <script>document.getElementById("endTime").value='21';
                             </script></td>
                </tr>
                <tr>
                    <td><input type="submit"  onclick="check();" class="login-submit-button" /></td><td></td>
                </tr>
            </table>
        </form>


    </div>

</div>
