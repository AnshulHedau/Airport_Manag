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
		<title>Cargo Details</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<style type="text/css">
	      body {
	        background-image:url("AirporT1.png");
		background-repeat:no repeat;
		background-position:left top;
		background-size:cover;
		background-attachment:   fixed  ;
		color:black;
		
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
               $Code = addslashes ($_POST['Code']);
			}else {
               $Code = $_POST['Code'];
               
            }
            
            $id = $_POST['id'];
            $sql = "SELECT *FROM FLIGHTS NATURAL JOIN CARGO WHERE FLIGHTS.FLIGHT_ID=(SELECT FLIGHT_ID FROM FLIGHTS WHERE FROM_AIRPORT_CODE='$Code' AND FLIGHT_ID='$id');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
            
			
			echo "
				
				<center>
				<div class='table table-striped' style='margin:30px 0px; color:black;'>
				
				
				<h2>Cargo Details</h2>
					<div class='container'>  	
						<div class='row'>
	    				<h4>	<div class='col-sm-1 col-sm-offset-1'>
								Flight ID<br />
							</div>
							<div class='col-sm-1'>
								From Airport<br />
							</div>
							<div class='col-sm-1'>
								To Airport<br />
							</div>
							
							
							<div class='col-sm-2'>
								Dept Date<br />	
								
							</div>
							<div class='col-sm-1'>
								Dept Time<br />
							
							</div>
							<div class='col-sm-2'>
								Arrival Date<br/>
							</div>
							
							<div class='col-sm-1'>
								Airlines Name<br/>
							</div>
							<div class='col-sm-1'>
								Capacity<br/>
							</div>
							
							</h4>
						</div>
					</div>
				</div>
				</center>
				";
				
				

            while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$Flight_ID = $row['FLIGHT_ID'];
				$From_Airport = $row['FROM_AIRPORT_CODE'];
				$To_Airport = $row['TO_AIRPORT_CODE'];
				$Baggage_Counter= $row['BAGGAGE_COUNTER'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];
				$Capacity = $row['CAPACITY'];


				echo "
				
				
				<div class='table table-striped' style='margin:30px 0px; color:black;'>
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-1 col-sm-offset-1'>
								$Flight_ID<br />
							</div>
							<div class='col-sm-1'>
								$From_Airport<br />
							</div>
							<div class='col-sm-1'>
								$To_Airport<br />
							</div>
							
							
							<div class='col-sm-2'>
								$Dept_Date<br />	
								
							</div>
							<div class='col-sm-1'>
								$Dept_Time<br />
							
							</div>
							<div class='col-sm-2'>
								$Arrival_Date<br/>
							</div>
							
							<div class='col-sm-1'>
								$Airlines_Name<br/>
							</div>
							<div class='col-sm-1'>
								$Capacity<br/>
							</div>
						</div>
					</div>
				</div>
				";


			}
						}
				else {
					?>
					<h3>No such Cargo Flight Found.</h3><br>
					<?php
				}
			mysqli_close($conn);
         }
		 else {
            
			
					include("style.php");
            ?>
            
			
			<div class="container">
				
					<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
						<h2> CARGO DETAILS </h2>
						<br />
						<br />
						<input type='text' id = "Code" name='Code' placeholder="Airport Code" required><br />
						<br/>
						<input type='text' id = "id" name='id' placeholder="Flight Id" required><br />
						<br/>
						<button id = "add" name = "add" type="submit" class="btn btn-info">
							<i class="icon-ok icon-white"></i> Submit
						</button>
						<button type="reset" class="btn">
							<i class="icon-refresh icon-black"></i> Clear
						</button>
               
			   </form>
			   </div>
            <?php
         }
      ?>
   
   </body>
</html>