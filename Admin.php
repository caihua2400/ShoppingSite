 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <?php 
       include("conn.php");
	   include("session.php");
       include("function.php");    
     ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Online Shopping Site</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
     <link rel="stylesheet" type="text/css" href="style.css"/>
     
    <script src="Home.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
     
    
    <body>
    <?php
        if( ($_SESSION['session_access']!=1) ){
            header('location: ./Home.php');
        }
        
        ?>
    <div>
        <div class="top">
            <div class="header"><h1 >You Can adminstrate stock information here</h1></div>
        </div>
    </div>
    
     <?php  include("navigator.tpl");   ?>
    
    <div class="homeBody">
    <div class=" homeParagraph"><br />
    <h2>The Best Online Laptop Shop</h2>
          
   
    
    <div id="main">
        <div>
      <table>
    <tr>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Description</th>
    </tr>
    <?php 
    
    
     $query = "select * from kit202_product ";
     $result = $conn->query($query);   
     while	($row=	$result->fetch_array(MYSQLI_ASSOC))
{ ?>  
  <tr>
    
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo	$row['Price']; ?></td>
    <td><?php echo	$row['Description']; ?></td>
</tr>
   <?php  
}	
?>
   
</table>
</div>
        <div>
            <form action="Admin.php" method="post">
            <fieldset>
            <legend>Update your product:</legend>
   <table>
       <tr>
           <td>ID :</td>
           <td><input type="text" name="ID" id="ID"/></td>
       </tr>
       <tr>
           <td>Name :</td>
           <td><input type="text" name="Name" id="Name"/></td>
       </tr>
       <tr>
           <td>Price :</td>
           <td><input type="text" name="Price" id="Price"/></td>
       </tr>
       <tr>
           <td>Description :</td>
           <td><input type="text" name="Description" id="Description"/></td>
       </tr>
       <tr>
           
           <td><input type="submit" name="update" id="update" value="update"/></td>
            
       </tr>
      
       
   </table>
                </fieldset>
</form>
       <?php 
    if(isset($_POST['update'])){
    $ID=test_input($_POST['ID']);  
    $Name=test_input($_POST['Name']);  
    $Price=test_input($_POST['Price']);  
    $Description=test_input($_POST['Description']);     
        
        
       // $sql="UPDATE kit202_product SET Name=?, Price=?, Description=? WHERE ID=?";
        $pre=$conn->prepare("UPDATE kit202_product SET Name=?, Price=?, Description=? WHERE ID=?");
        $pre->bind_param("ssss",$Name,$Price,$Description,$ID);
        $status=$pre->execute();
        if($status==1){
            echo "<script>alert('success');window.location='./Admin.php'</script>";
        }
    }
    ?>
        </div>
        <div>
            <form action="Admin.php" method="post">
            <fieldset>
             <legend>delete your product:</legend>
   <table>
       <tr>
           <td>ID :</td>
           <td><input type="text" name="ID" id="ID"/></td>
       </tr>
       
       
       
       <tr>
           
           <td><input type="submit" name="delete" id="delete" value="delete"/></td>
          
       </tr>
       
       
   </table>
                </fieldset>
</form>
<?php 
    if(isset($_POST['delete'])){
    $ID=test_input($_POST['ID']);  
      
        
       
        $pre=$conn->prepare("DELETE FROM kit202_product  WHERE ID=?");
        $pre->bind_param("s",$ID);
        $status=$pre->execute();
        if($status==1){
            echo "<script>alert('success');window.location='./Admin.php'</script>";
        }
    }
    ?>
        </div>
        <div>
            <form action="Admin.php" method="post" enctype="multipart/form-data">
            <fieldset>
             <legend>insert a new product:</legend>
   <table>
       <tr>
           <td>ID :</td>
           <td><input type="text" name="ID" id="ID"/></td>
       </tr>
       <tr>
           <td>Name :</td>
           <td><input type="text" name="Name" id="Name"/></td>
       </tr>
       <tr>
           <td>Price :</td>
           <td><input type="text" name="Price" id="Price"/></td>
       </tr>
       <tr>
           <td>Description :</td>
           <td><input type="text" name="Description" id="Description"/></td>
       </tr>
       <tr>
           <td>Select image to upload: </td>
           <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
       </tr>
       <tr>
           
           <td><input type="submit" name="insert" id="insert" value="insert"/></td>
           
       </tr>
      
       
   </table>
    </fieldset>
</form>
<?php 
    if(isset($_POST['insert'])){
    $ID=test_input($_POST['ID']);  
    $Name=test_input($_POST['Name']);  
    $Price=test_input($_POST['Price']);  
    $Description=test_input($_POST['Description']);   
        
   $target_dir = "./picture/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
      
      
        $pre=$conn->prepare("INSERT INTO kit202_product (ID,Name,Price,Description,path) VALUES (?,?,?,?,?)");
        $pre->bind_param("sssss",$ID,$Name,$Price,$Description,$target_file);
        $status=$pre->execute();
        if($status==1){
            echo "<script>alert('success');window.location='./Admin.php'</script>";
        }
    }
    ?>
        </div>
 
</div>	  
    
        <p id="date" >hahaß</p>
        <div id="footer">Made by Hua Cai Copy-writed   Username: hcai1  Student Number: 424583</div>
    </div>
    </div>
    </div>
    
    </body>
    </html>