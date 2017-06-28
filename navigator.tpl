
        <div class="nav">
        <a href="Home.php">Home</a>
        <a href="Sign up.php">Sign up</a>
         <?php 
 if(isset($_SESSION['session_access'])&& $_SESSION['session_access']==2){
     
    ?>
        <a href="Trolley.php" >Trolley</a>
        <?php
        }
        ?>
        <?php 
 if(isset($_SESSION['session_access'])&& $_SESSION['session_access']==1){
     
    ?>
        <a href="Admin.php" >Admin</a>
        <?php
        }
        ?>
         <?php 
 if(isset($_SESSION['session_user'])){
     
    ?>
    <a href='signout.php'>log out</a>
     <?php
        }
        ?>
        <?php 
 if(isset($_SESSION['session_user']) && $_SESSION['session_access']==2){
     
    ?>
    <a href='deliver.php'>deliver</a>
     <?php
        }
        ?>
    </div>