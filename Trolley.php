 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Online Shopping Site</title>
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
            <div class="header"><h1 >Online Shopping Site</h1></div>
        </div>
    </div>
    
     <?php  include("navigator.tpl");   ?>
    
    <div class="homeBody">
    <div class=" homeParagraph"><br />
    <h2>The Best Online Laptop Shop</h2>
        <table>
        <tr>
		<th>ID</th>
		<th>Product_Name</th>
		<th>Product_description</th>
		<th>Price</th>
		<th>Action</th>
		<th>Confirm</th>
		
	</tr>
        
         <?php 
        if(isset($_SESSION['session_user'])){
         	
       
        $cust_id=$_SESSION['session_user'];
        $query_get="select * from trolley where cust_id='$cust_id' and paid='N' ";
        $query_sum="select SUM(Price) from trolley where cust_id='$cust_id' and paid='N' ";
        $result_sum= $conn->query($query_sum);
        $result= $conn->query($query_get);  
        $count=mysqli_num_rows($result);
        $row_sum = $result_sum->fetch_assoc();
            
while ($row = $result->fetch_assoc()) { ?>
        
        <form action='Trolley.php' method='post'>
		<tr>
			<td><input type='text' value="<?php echo $row["ID"] ?>"  name='product_ID' readonly/></td>
			<td><?php echo $row["product_name"] ?></td>
			<td><?php echo $row["product_description"] ?></td>
			<td><?php echo $row["Price"] ?></td>
			
			<td><select id="action" name="action"  >
					<option value="Y" <?php if($row['paid']=='N'){ echo "selected='selected'" ?> <?php } ?> >Check Out</option>
					<option value="N" <?php if($row['paid']=='Y'){ echo "selected='selected'" ?> <?php } ?> >Remove</option>
				</select></td>
			<td><input type='submit' value='confirm' name="submit"/></td>
			
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
    
     <?php 
    if(isset($_POST['submit']) && isset($_SESSION['session_user'])){
    $action=$_POST['action'];  
        
    $username=$_SESSION['session_user'];  
    $ID=$_POST['product_ID'];    
           if($action=='Y'){    
        $pre=$conn->prepare("UPDATE trolley SET paid=? WHERE ID=?");
        $pre->bind_param("si",$action,$ID);
        $status=$pre->execute();
        if($status==1){
            echo " check out success";
             header('location: ./Trolley.php');
            
            
        }
        
           }else{
               $pre=$conn->prepare("DELETE FROM trolley   WHERE ID=?");
               $pre->bind_param("s",$ID);
               $status=$pre->execute();
               if($status==1){
             echo " delete success from trolley";
             header('location: ./Trolley.php');
            
            
        }
           }
      }
    ?>
  
     
       
        <p id="date" >hahaß</p>
        <div id="footer">Made by Hua Cai Copy-writed   Username: hcai1  Student Number: 424583</div>
    </div>
    </div>
    
    
    </body>
    </html>
