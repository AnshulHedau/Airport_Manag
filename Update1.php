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
		<title>Update the Employee Name</title>
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
            
            if(! get_magic_quotes_gpc() ) {
               $Code = addslashes ($_POST['Name']);
			}else {
               $Code = $_POST['Name'];
               
            }
            
            $id = $_POST['password'];
			$sql1 = "update employee set Name='$Code' where AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass') and id='$id';";
            mysqli_select_db( $conn,'test_db');
            $retval1 =  mysqli_query( $conn , $sql1);
            $sql = "Select * from employee where AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass') and id='$id';";
               
            $retval =  mysqli_query( $conn , $sql);
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
				$AGE= $row['AGE'];
				$SHIFT= $row['Shift'];
				$ID= $row['ID'];
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
		 else {
            
			include('style.php');
			?>
			<div class="container">
				
				
					<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
							<h3> Update Name </h3><br />
							<input type='text' id = "Name" name='Name' placeholder="Correct Employee Name" required><br />
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
			<script type="text/javascript" src="js/bootstrap.js"></script>
		
                 
            <?php
         }
      ?>
   
   </body>
</html>