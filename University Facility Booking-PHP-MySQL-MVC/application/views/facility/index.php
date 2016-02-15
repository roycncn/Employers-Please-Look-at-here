<div class="content">

<script type="text/javascript">
function check(){
    var av=false;
        box_a=document.getElementById("location_box").getElementsByTagName("input");
            for(var i=0;i<box_a.length;i++){
                if(box_a[i].checked==true){
                    av=true;
                    break;
                    }
                }   

        if(av!=true){
                alert("Please Choose at least one Location");
                window.event.returnValue=false;
                }
    }
</script>
<style type="text/css">
label, input
{
  float:left;
   white-space: nowrap;

}
</style>


    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box" align="center">
        <h1>Facilty Query</h1>

            <form action="<?php echo URL; ?>facility/query" method="post">
                     <table class="facility-query">
            <tr> 
                <td>Date: </td>
                <td><input type="text" name="date" value="2014-11-26" required /></td>
            </tr>    

                
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="Sports">Sports</option>
                        <option value="Studying Room">Studying Room</option>
                        <option value="Classroom">Classroom</option>
                    </select>   
                </td>
            </tr>

            <tr>    
                <td>Location:</td>
               <td>
                <div id="location_box">
               <input type="checkbox" name="location[]" value="aab" /> <label>AAB</label>
               <input type="checkbox" name="location[]" value="scc" /> <label>SCC</label>
               <input type="checkbox" name="location[]" value="mhall"/><label>MHall</label>
                </div>
                </td>

            </tr>   
                     
                    
             </table>
                </br>
             <input type="submit" onclick="check()" class="login-submit-button" />
             </form>
        

        


    </div>

</div>
