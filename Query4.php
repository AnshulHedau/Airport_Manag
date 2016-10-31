<?php
session_start();
if ($_SESSION['authuser'] != 1)
{echo 'sORRY  You dont have permission to view this fIlee   ';
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
		<title>View Employee</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<style type="text/css">
	      body {
	        background-image:url("AirporT1.png");
		background-repeat:no repeat;
		background-position:left top;
		background-size:cover;
		background-attachment:   fixed  ;
		color:white;
		
		text-align:center;
		font-family:Roboto;
	        padding-top: 0px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
	      }

	      .form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
			margin: 80px auto 20px;
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
		
         if(isset($_POST['add'])) {
			 include('Admin_info.php');
            include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
            $sql = "select employee.Name as Name,Phone,employee.Sex as Sex,employee.AGE as Age,employee.Shift as Shift,employee.ID as Id,employee.Authority as Authority from employee natural join airlinesemp where employee.AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
				
			echo "<div class='table table-striped' style='margin:30px 0px;color:black;'>
					<h2>Employee Details</h2>
					<div class='container'>  	
						<div class='row'>
	    					<h3><div class='col-sm-2 col-sm-offset-1'>
								Name<br />
							</div>
							<div class='col-sm-2'>
								Phone<br />
							</div>
							<div class='col-sm-1'>
								Sex<br />
							</div>
							<div class='col-sm-1'>
								Age<br />
							</div>
							<div class='col-sm-1'>
								Shift<br />
							</div>
							<div class='col-sm-2'>
								Id<br />
							
							</div>
							<div class='col-sm-1'>
								Authority<br  />
							</div></h3>
					
						</div>
					</div>
					
				</div>"
				
				
				
				;

			while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$NAME = $row['Name'];
				$PHONE = $row['Phone'];
				$SEX = $row['Sex'];
				$AGE= $row['Age'];
				$SHIFT= $row['Shift'];
				$ID= $row['Id'];
				$AUTHORITY= $row['Authority'];
				


				echo " <div class='table table-striped' style='margin:30px 0px; color:black;'>
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-2 col-sm-offset-1'>
								$NAME<br />
							</div>
							<div class='col-sm-2'>
								$PHONE<br />
							</div>
							<div class='col-sm-1'>
								$SEX<br />
							</div>
							<div class='col-sm-1'>
								$AGE<br />
							</div>
							<div class='col-sm-1'>
								$SHIFT<br />	
								
							</div>
							<div class='col-sm-2'>
								$ID<br />
							
							</div>
							<div class='col-sm-1'>
								$AUTHORITY<br/>
							</div>
						</div>
					</div>
				</div>
				";



  
		
			}
						}
				else {
					?>
					Invalid input<br>
					<?php
				}
            mysqli_close($conn);
         }
		      else if(isset($_POST['add1'])) {
				  include('Admin_info.php');
            include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
            
            $sql = "select employee.Name as Name,Phone,employee.Sex as Sex,employee.AGE as Age,employee.Shift as Shift,employee.ID as Id,employee.Authority as Authority from employee natural join airportemp where employee.AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
			
			
			echo "<div class='table table-striped' style='margin:30px 0px;color:black;'>
					<h2>Employee Details</h2>
					<div class='container'>  	
						<div class='row'>
	    					<h3><div class='col-sm-2 col-sm-offset-1'>
								Name<br />
							</div>
							<div class='col-sm-2'>
								Phone<br />
							</div>
							<div class='col-sm-1'>
								Sex<br />
							</div>
							<div class='col-sm-1'>
								Age<br />
							</div>
							<div class='col-sm-1'>
								Shift<br />
							</div>
							<div class='col-sm-2'>
								Id<br />
							
							</div>
							<div class='col-sm-1'>
								Authority<br  />
							</div></h3>
					
						</div>
					</div>
					
				</div>"
				
				
				
				;

			while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$NAME = $row['Name'];
				$PHONE = $row['Phone'];
				$SEX = $row['Sex'];
				$AGE= $row['Age'];
				$SHIFT= $row['Shift'];
				$ID= $row['Id'];
				$AUTHORITY= $row['Authority'];
				


				echo " <div class='table table-striped' style='margin:30px 0px; color:black;'>
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-2 col-sm-offset-1'>
								$NAME<br />
							</div>
							<div class='col-sm-2'>
								$PHONE<br />
							</div>
							<div class='col-sm-1'>
								$SEX<br />
							</div>
							<div class='col-sm-1'>
								$AGE<br />
							</div>
							<div class='col-sm-1'>
								$SHIFT<br />	
								
							</div>
							<div class='col-sm-2'>
								$ID<br />
							
							</div>
							<div class='col-sm-1'>
								$AUTHORITY<br/>
							</div>
						</div>
					</div>
				</div>
				";



  
		
			}
						}
				else {
					?>
					<h2>No Employee Found</h2><br>
					<?php
				}
            mysqli_close($conn);
         }
		     else if(isset($_POST['add2'])) {
				  include('Admin_info.php');
				  include('Query3.php');
            
         }
		 else {
            include("style.php");

            ?>
            
			
				<div class="container">
				<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
							<h3 style="color:black;"> Employee Search </h3><br />
							<button id = "add" name = "add" type="submit" value="Airline employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Airline employee Search
							</button>
							<br /><br />
							
							<button id = "add1" name = "add1" type="submit" value="Airport employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Airport employee Search
							</button>
							<br /><br />
							
							<button id = "add2" name = "add2" type="submit" value="Airport employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i> ALL Employee Search
							</button>
							<br /><br />
							
						</center>
					</form>
			</div>
			<script type="text/javascript" src="js/bootstrap.js"></script>
		
               
            <?php
         }
      ?>
   
   </body>
</html>