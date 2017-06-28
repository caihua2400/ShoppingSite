<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("conn.php");
include("session.php");   
include("function.php");   
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sign up</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
 <link rel="stylesheet" type="text/css" href="style.css"/>

<script src="http://code.jquery.com/jquery-latest.js"></script>
 <script type="text/javascript">
    $(document).ready(function() {
     	
     	// make button not submit a form (if type is not submit)
     	$('button[type!=submit]').click(function(){
        	// code to cancel changes
        	return false;
    	});

	    // when user clicks the check button id='check', execute the following function
	    $("#check").click( function () {
	      	
	      		// get the value of username field and assign as username.
	     		var username = $("#username").val();
	      		
	      		// send the data 'username' as username to checker.php and execute the following function (if the data sending is successful)
	      		$.get( "checker.php", { username: username} )
				  .done(function( data ) {
				  		// print the data (output of checker.php) as a label for 'username' id='output'
					    $("#output").html(data);
				});     	
	    });       
     });
</script>
 <script type="text/javascript">
      function update_month(){
         //assigns the selected year to year variable.
		 //assigns the default month to month variable.
         var year = $('#year').val();
		 var month="";
		 //get_month.php performs when the year is selected.
         //call the function(show_months) when the data is returned from get_cities.php.
         $.post('get_month.php?year='+year,show_months);
		 $.post('get_day.php?year='+year+'&month='+month, show_days);
      }
      
      function show_months(month){
         //returned data from get_cities.php is assigned to cities
	     //change the field(drop down list)
         $('#month').html(month);
		}
	
       function update_days(){
		   var month=$('#monthselect').val();
		   var year =  $('#year').val();
		   $.post('get_day.php?year='+year+'&month='+month, show_days);
	   }
	   function show_days(days){
		   $('#day').html(days);
	   }
      
   </script>
<script type="text/javascript">  
   var statesUSA=["California", "Illinois", "Wisconsin"];
   var statesCanada=["Quebec", "Ontario", "Alberta"];
   var statesAustralia=["Tasmania", "NSW", "WestAustralia"];
   
   var citiesCalifornia=["Los Angeles", "San Francisco"];
   var citiesIllinois=["Chicago", "Springfield"];
   var citiesWisconsin=["Milwaukee", "Madison"];
   var citiesQuebec=["Montreal", "Brossard"];
   var citiesOntario=["Toronto", "Ottawa"];
   var citiesAlberta=["Calgary", "Edmonton"];
   var citiesTasmania=["Hobart", "Lauceston"];
   var citiesNSW=["Syndey", "NewCastle"];
   var citiesWestAustralia=["Perth", "Adi"];
   
   function countryChanged(country)
   {  
      var selectState = document.getElementById('states');
      var ln = selectState.length - 1;
      while (ln > 0)
      { 
        selectState.remove(1);  //Remove all but "Select State"
        ln--;
      }
      
      var selectCity = document.getElementById('cities');
      var ln = selectCity.length - 1;
      while (ln > 0)
      { 
        selectCity.remove(1);  //Remove all but "Select City"
        ln--;
      }    
      
      var stateArray;
      
      switch(country)
      {
        case "USA":
            stateArray=statesUSA
            break;
        case "Canada":
            stateArray=statesCanada
            break;
        case "Australia":
            stateArray=statesAustralia
            break;
        default:
      }      
          
      for (i = 0; i < stateArray.length; i++)
      {
        var option = document.createElement('option'); 
        option.text = stateArray[i];
        option.value = stateArray[i];
        selectState.add(option);
      }      
  }
  
  function stateChanged(state)
  {  
     var selectCity = document.getElementById('cities');
     var ln = selectCity.length - 1;
     while (ln > 0)
     { 
       selectCity.remove(1);  //Remove all but "Select City"
       ln--;
     }    
     
     var cityArray;
     
     switch(state)
     {
       case "California":
           cityArray=citiesCalifornia
           break;
       case "Illinois":
           cityArray=citiesIllinois
           break;
       case "Wisconsin":
           cityArray=citiesWisconsin
           break;
       case "Quebec":
           cityArray=citiesQuebec
           break;
       case "Ontario":
           cityArray=citiesOntario
           break;
       case "Alberta":
           cityArray=citiesAlberta
           break;
       case "Tasmania":
           cityArray=citiesTasmania
           break;
       case "NSW":
           cityArray=citiesNSW
           break;
       case "WestAustralia":
           cityArray=citiesWestAustralia
           break;            
       default:
     }   
      
     for (i = 0; i < cityArray.length; i++)
     {
       var option = document.createElement('option'); 
       option.text = cityArray[i];
       option.value = cityArray[i];
       selectCity.add(option);
     }      
  }
  
 function cityChanged(city)
  {  
    
  } 
  </script>
</head>
<?php

 
	
if(isset($_POST['submit'])){
	$username=test_input($_POST['username']);
    $password=test_input($_POST['password']);
    $retypepassword=test_input($_POST['retypepassword']);
	$name=test_input($_POST['name']);
	
    $email=test_input($_POST['email']);
	
	
	$year=$_POST['year'];
	if($year!="")
	{
		$month=$_POST['months'];
		$day=$_POST['days'];
		if($day=="")
			$day="01";
		if($month=="")
			$month="01";
		$DOB="$year-$month-$day";
	}
	else{
		$DOB=$_POST['DOB'];
	}

    //setting the error message
    $error="";
     if($username==""){
    	$error.="* Please type your username"."<br/>";
    }else
	{
		$result=$conn->query("SELECT `Username` FROM `customers` WHERE `Username` LIKE '$username'");
		$result_cnt = $result->num_rows;
		
		if ($result_cnt!=0){
			$error.="* Username exists. Please reselect your username"."<br/>";
		}	
	}   
    //name validation
    if($name==""){
    	$error.="* Please type your name"."<br/>";
    }
    //password validation 
	
    if($password==""){
    	$error.="* Please type the password"."<br/>";
    }
    elseif(strlen($password)<5){
    	//if the password is under 6 and over 8 characters
    	$error.="* The password must be at least 5 characters"."<br/>";
    }
   
 	
 	
	
	//email validation
	if($email==""){
        $error.="* Please type your email address"."<br/>";
	}elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
		//if the email is not proper..(format)
		$error.="* Please type the correct format of email address"."<br/>";
    }
    
    //comment validation
    
    if($password!==$retypepassword)
	{$error.="* Please type the same password"."<br/>";}
	
    if($error==""){
    	//encrypt password
    	$encrypt_password=MD5($password);
        $date_field=date('Y-m-d',strtotime($DOB));
    	//Escapes special characters in a string for use in an SQL statement
    	//query for inserting
    	$insertquery="INSERT INTO `customers`(`Username`, `Password`, `Name`, `DOB`, `Email`,`Access`) VALUES ('$username','$encrypt_password','$name','$date_field','$email','2')";
    	//execute the insert query
    	$conn->query($insertquery);
    	
			$_SESSION['session_user']=$username;
			
			$_SESSION['session_access']=2;
	 echo "<script>alert('Hello $username, you have successfully registered');window.location='./Home.php'</script>"; 
    }
  
}
?>

<body>
<div>
<div class="top">
	<div class="header"><h1 >Please Sign Up your personal information</h1></div>
</div>
</div>
  <?php  include("navigator.tpl");   ?>
<div class="homeBody">
<div class=" homeParagraph"><h1>This is done by Hua Cai</h1><br />
<form action="" method="post" id="A1" >
<fieldset>
<legend>Register</legend>
<table id="form">
<tr>
<td>
<label for="username">&nbsp;* Enter your Username:</label>
</td>
<td>
<input type="text" id="username" name="username" value="<?php if(isset($username)) echo $username; ?>"/></td><td><button id="check">Check</button></td><td><label id="output" for="username"></label></td>
</tr>
<tr>
<td>
<label for="password">&nbsp;* Enter your password:</label>
</td>
<td>
<input type="password" id="password" name="password" />
</td>
</tr>
<tr>
<td>
<label for="retypepassword">&nbsp;* Retype your password:</label>
</td>
<td>
<input type="password" id="retypepassword" name="retypepassword"/>
</td>
</tr>
<tr>
<td>
<label for="name">&nbsp;* Enter your Name:</label>
</td>
<td>
<input type="text" id="name" name="name" value="<?php if(isset($name)) echo $name; ?>"/>
</td>
</tr>
<tr>
<td>
<label for="gender">&nbsp;select your gener:</label>
</td>
<td>
<input type="radio" name="gender" value="male" checked> Male<br/>
 </td>
 <td>
  <input type="radio" name="gender" value="female"> Female<br/>
 </td>
  </tr>
  <tr>
  <td>
<label for="country">&nbsp;Enter your Country:</label>
</td>
<td>
 <select id='countries' class="country" onchange='countryChanged(this.value);'>
    <option value=''>Select Country</option>
    <option value='USA'>USA</option>
    <option value='Canada'>Canada</option>
    <option value='Australia'>Australia</option>
  </select>
  </td>
  <td>
  &nbsp;&nbsp;
  <select id='states' class="state" onchange='stateChanged(this.value);'>
    <option value=''>Select State</option>
  </select>
  </td>
  <td>
  &nbsp;&nbsp; 
  <select id='cities' class="city" onchange='cityChanged(this.value);'>
    <option value=''>Select City</option>
  </select>
  </td>
  </tr>
  


    <tr>
       <td class="label">* Date Of Birth</td>
        <td><input type="text" name="DOB" value="<?php if(isset($DOB)) echo $DOB; ?>" readonly/></td>
        <td>
            <select name="year" id="year" onchange="update_month()">
                <option value="" selected="selected">Please Select Year</option>
			<?php     
				for ($i = 2010; $i >1900; $i--)
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			?>
               </select>    
        </td>
         <td id="month"></td>
         <td id="day"></td>
    </tr>

                       


   <tr>  
   <td>
<label for="Email" >&nbsp;&nbsp;* E-mail Address:</label>
</td>
<td>
<input type="text" name="email" id="email" />
</td>
</tr>     
<tr>
<td>
<input type="submit" value="Sign up" name="submit" onclick="check()"/>
</td>
<td>
<input type="reset" value="Reset" name="reset" onclick="check()"/>
</td>
</tr>
<tr>
    		<td colspan="2">
    		<?php    		
			if (isset($error)) {
    			echo $error; 
			} 
			else echo "* Theses fields must be filled <BR/>
			Password must contain at least 8 characters which must not include
			<BR/> any spaces (all other characters are acceptable).";
			?></td>
    	</tr>
</table>
</fieldset>
</form>



</div>

</div>
        <div id="footer">Made by Hua Cai Copy-writed   Username: hcai1  Student Number: 424583</div>
          <script>   
    $(document).ready(function() {
    	$("select#month").hide();
		$("select#day").hide();
		$("select#year").change(function(){$("select#month").show();});
        $("select#month").change(function(){$("select#day").show();});
		
		
					 
    });
              $(document).ready(function() {
    	$("select.state").hide();
		$("select.city").hide();
		$("select.country").change(function(){$("select.state").show();});
        $("select.state").change(function(){$("select.city").show();});
		
		
					 
    });
    </script>
</body>
</html>