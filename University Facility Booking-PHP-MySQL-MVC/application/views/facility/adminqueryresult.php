<div class="content">
  <style>
table, th,tr, td {
    border: 1px solid black;
    border-collapse: collapse;
    height:25px;
}
</style>

    <h1>Query Result</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
         <?php 
                if($this->facility) {?>

        <div class="facility" align="center" >
      <table class="all-facility" >
        
          <tr>
            <td>
        <table>
        <?php
              echo "<tr><th></br></br></br></br></th></tr>";
          for($i = 9; $i < 21; $i++)
          {
            echo "<tr><td>".$i.":00</td></tr>";
          }
        ?>
      </table>
</td>


                
        <?php 
        foreach ($this->facility as $facility) { ?>

           <td>
                    <table class="each-facility">
              <th>Name: <?php echo $facility->fname; ?></br>
                Location: <?php echo $facility->location; ?></br>
                Min User: <?php echo $facility->minuser; ?></br>
                Data: <?php echo $facility->date; ?></th>
            
              <?php
                $i=strlen($facility->avatime);
                $arr=str_split($facility->avatime);
                for($j=1;$j<$i;$j++){
                ?>

               <?php if($arr[$j]==0) {?> 
               <tr>
              <td>
                  Yes
              </td>
                </tr>

          </td>
                <?php }else {?>

              <tr>
                <td>
                  No
                </td>
              </tr>

                <?php } ?>
              <?php } ?>
            </tr>
             </table> 

       <?php } ?>  
</table>
</div>
  

       <?php 

              } else { ?>

        <p>
            No Reacording!
        </p>

       <?php } ?>

    </p>
</div>
