 <?php 
      
include("conn.php");      
?>
      <?php
      
      ?>
       <table>
        <tr>
        <th>Picture</th>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Description</th>
		 <?php 
            if(isset($_SESSION['session_user'])&& $_SESSION['session_access']==2){
            ?>
		<th>Buy</th>
		<?php
		} ?>
		
	</tr>
        
         <?php 
       
         	
     $query = "select * from kit202_product ";
     $result = $conn->query($query); 
       
            
while ($row = $result->fetch_assoc()) { ?>
        
        <form action='Home.php' method='post'>
		<tr>
		    <td><img src="<?php echo $row['path'] ?>"  style="width:75px;height:75px;"></td>
			<td><input type='text' value="<?php echo $row["ID"] ?>"  name='product_ID' readonly/></td>
			<td><?php echo $row["Name"] ?></td>
			<td><?php echo $row["Description"] ?></td>
			<td><?php echo $row["Price"] ?></td>
			
			 <?php 
            if(isset($_SESSION['session_user'])&& $_SESSION['session_access']==2){
            ?>
			<td><input type='submit' value='Buy' name="submit"/></td>
			<?php
		} ?>
			
		</tr>
		
	</form>
  <?php } 
          
       
            
       ?>
    
   </table>