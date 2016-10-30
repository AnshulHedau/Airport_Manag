<?php
session_start();
if ($_SESSION['authuser'] != 1)
{echo 'SORRY  You dont have permission to view this file   ';
exit();
}
else{
	$User=$_SESSION['Username'];
	$Pass=$_SESSION['password'];
}
?>


<html>
   
   
   <head>
      <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Delete the Employee</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<style type="text/css">
	      body {
	        padding-top: 0px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
	      }

	      .form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
	        margin: 0 auto 20px;
	        background-color: #fff;
	        border: 1px solid #e5e5e5;
	        -webkit-border-radius: 5px;
	           -moz-border-radius: 5px;
	                border-radius: 5px;
	        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	                box-shadow: 0 1px 2px rgba(0,0,0,.05);
	      }
	      .form-signin .form-signin-heading,
	      .form-signin .checkbox {
	        margin-bottom: 10px;
	      }
	      .form-signin input[type="text"],
	      .form-signin input[type="password"] {
	        font-size: 16px;
	        height: auto;
	        margin-bottom: 15px;
	        padding: 7px 9px;
	      }

	    </style>
   </head>
   
   <body>
      <?php
          include('style.php');
         if(isset($_POST['add'])) {
            include('Admin_info.php');
			include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            if(! get_magic_quotes_gpc() ) {
               $Code = addslashes ($_POST['Name']);
			}else {
               $Code = $_POST['Name'];
               
            }
            
            $id = $_POST['password'];
			$sql1 = "delete from employee where AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass') and id='$id' and name='$Code';";
            mysqli_select_db( $conn,'test_db');
            $retval1 =  mysqli_query( $conn , $sql1);
            echo"<h2><br /><br /><center> Employee Deleted </center></h2>";
            
				

            mysqli_close($conn);
         }
		 else {
            

			?>
			<div class="container">
				<div class="row well">
				
					<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
							<input type='text' id = "Name" name='Name' placeholder="Employee Name to Delete" required><br />
						<br/>
							<input name = "password" type = "text" id = "password" placeholder="Employee ID" required><br />
							<br><br>
							<button id = "add" name = "add" type="submit" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Submit
							</button>
							<button type="reset" class="btn">
								<i class="icon-refresh icon-black"></i> Clear
							</button>
							
						</center>
					</form>
				
				</div>
			</div>
			<script type="text/javascript" src="js/bootstrap.js"></script>
		
                 
            <?php
         }
      ?>
   
   </body>
</html>