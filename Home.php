    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Online Shopping Site</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <script src="Home.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
     <?php 
       include("conn.php");
	   include("session.php");
       include("function.php");    
     ?>
    
    <body>
    
    
    <div>
        <div class="top">
            <div class="header"><h1 >Online Shopping Site</h1></div>
            
    </div>
        </div>
        
    
    
     <?php  include("navigator.tpl");   ?>
    
    <div class="homeBody">
    <div class=" homeParagraph"><br />
    <h2>The Best Online Laptop Shop</h2>
          <?php
        if(!isset($_SESSION['session_user'])){
        ?>
           <div class="login">
<table>
			<form action="login.php" method="post">
  
	<tr>
    		<td>Username:</td>
    		<td><input name="username" type="text" id="username" ></td>
 		</tr>
 		<tr>
 	    	<td>Password:</td>
 	    	<td><input name="password" type="password" ></td>
      	</tr>
      	<tr>
			<td></td>
			<td><input type="submit" name="login" value="Log In">
			</br>
			<input type="reset" name="reset" value="Reset"></td>
		</tr>	
			

		</form>
</table>
</div>
  <?php
   }
        ?>
    
    <div class="section">
        <div>
            <?php include("product.tpl")?>
            <?php 
             if(isset($_POST['submit'])){
                  $ID=test_input($_POST['product_ID']);
                    $query_get="SELECT * FROM kit202_product WHERE ID='$ID'";
                 $result= $conn->query($query_get);
                  while	($row=	$result->fetch_array(MYSQLI_ASSOC)){
                      $Price=$row['Price'];
                      $product_name=$row['Name'];
                      $product_description=$row['Description'];
                  }
                $buyername=$_SESSION['session_user'];
                $cart_ID=$ID;
                $paid="N";
                //$message=$ID."".$buyername."".$paid."".$Price."".$product_name."".$product_description;
                 
                 $pre=$conn->prepare("INSERT INTO trolley (cart_id,cust_id,paid,Price,product_name,product_description) VALUES (?,?,?,?,?,?)");
                 $pre->bind_param("dssdss",$ID,$buyername,$paid,$Price,$product_name,$product_description);
                 $status=$pre->execute();
                 if($status==1){
                      echo "<script>alert('success');window.location='./Home.php'</script>";
                 }else{
                     echo $status;
                 }
                
                  
                
            }
            
            ?>
           
        </div>
       
      
      
 
</div>	  
    
        <p id="date" >hahaß</p>
        <div class="footer">Made by Hua Cai Copy-writed   Username: hcai1  Student Number: 424583</div>
      
    </div>
    </div>
    
    
    </body>
    </html>