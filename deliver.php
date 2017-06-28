<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
     <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="Home.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
    <?php
      include("conn.php");
	   include("session.php");
       include("function.php");
    ?>
    <body>
        <?php
        if( ($_SESSION['session_access']!=2) ){
            header('location: ./Home.php');
        }
        
        ?>
        <div>
        <div class="top">
            <div class="header"><h1 >Deliver your product</h1></div>
        </div>
    </div>
       <?php  
        
        include("navigator.tpl");   ?>
       <div class="homeBody">
        <div class=" homeParagraph"><br />
          <table>
        <tr>
		<th>ID</th>
		<th>Product_Name</th>
		<th>Product_description</th>
		<th>Price</th>
		
		
	</tr>
        
         <?php 
        if(isset($_SESSION['session_user'])){
         	
       
        $cust_id=$_SESSION['session_user'];
        $query_get="select * from trolley where cust_id='$cust_id' and paid='Y' ";
        $query_sum="select SUM(Price) from trolley where cust_id='$cust_id' and paid='Y' ";
        $result_sum= $conn->query($query_sum);
        $result= $conn->query($query_get);  
        $count=mysqli_num_rows($result);
        $row_sum = $result_sum->fetch_assoc();
            
while ($row = $result->fetch_assoc()) { ?>
        
        <form action='Trolley.php' method='post'>
		<tr>
			<td><?php echo $row["ID"] ?></td>
			<td><?php echo $row["product_name"] ?></td>
			<td><?php echo $row["product_description"] ?></td>
			<td><?php echo $row["Price"] ?></td>
			
			
			
		</tr>
		
	</form>
  <?php } 
          
        }
            
       ?>
    <tr>
        <td>Total Price</td>
        <td><?php echo $row_sum["SUM(Price)"] ?></td>
    </tr>
   </table><br>
        <form action="deliver.php" method="post">
           <fieldset>
           <legend>Submit your delivery address</legend>
            <table>
                <tr>
<td>
<label for="address">&nbsp;* Enter your address:</label>
</td>
<td>
<input type="text" id="address" name="address" />
</td>
</tr>
            <tr>
<td>
<label for="phone">&nbsp;* Enter your phone number:</label>
</td>
<td>
<input type="text" id="phone" name="phone" />
</td>
</tr>
           <tr>
<td>
<input type="submit" value="deliver" name="deliver" />
</td>
<td>
<input type="reset" value="Reset" name="reset" />
</td>
</tr>
            </table>
            </fieldset>
        </form>
         <?php
        if(isset($_POST['deliver']) ){
             $error="";
           $address=$_POST['address'];
           $phone=$_POST['phone'];
            if($address==""){
    	    $error.="* Please type your address"."<br/>";
            }
            if($phone==""){
                 $error.="* Please type your phone number"."<br/>";
            }
             if($error==""){
    	$query_delete_trolley="DELETE FROM trolley  WHERE cust_id='$cust_id' and paid='Y'";
        $conn->query($query_delete_trolley);         
		echo "You have successfully delivered! Redirecting to Home area.</br>";
		$newpage="./Home.php";
    	//automatically go to myarea.php
        header("REFRESH: 2; URL=$newpage");
    }else {
                 echo "<script>alert('$error');</script>";
                
             }
}
       
        
        ?>
            <p id="date" >hahaß</p>
        <div id="footer">Made by Hua Cai Copy-writed   Username: hcai1  Student Number: 424583</div>
           </div>
        </div>
    </body>
</html>