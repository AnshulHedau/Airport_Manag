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
		<title>Update the Employee Number</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<style type="text/css">
	      body {
	        padding-top: 40px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
			color:black;
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
         
        if(isset($_POST['add1'])) {
            
			include('Admin_info.php');
			include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            if(! get_magic_quotes_gpc() ) {
               $bag = addslashes ($_POST['Name']);
			}else {
               $bag = $_POST['Name'];
               
            }
            
            $id = $_POST['Name1'];
			$sql2 = "Select * from flights where FLIGHT_ID ='$id';";
               
            $retval2 =  mysqli_query( $conn , $sql2);
			$sql1 = "update Flights set No_of_passenger='$bag' where FROM_AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass') and Flight_ID='$id';";
            mysqli_select_db( $conn,'test_db');
            $retval1 =  mysqli_query( $conn , $sql1);
            $sql = "Select * from flights where FLIGHT_ID ='$id';";
               
            $retval =  mysqli_query( $conn , $sql);
			echo "
				<div style='margin:30px 0px;color:black;'>
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-1 col-sm-offset-1'>
								Flight_ID
							</div>
							<div class='col-sm-1'>
								From_Airport
							</div>
							<div class='col-sm-1'>
								To_Airport
							</div>
							<div class='col-sm-1'>
								No. of Passengers
							</div>
							<div class='col-sm-5'>
								Dept_Date	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	Dept_Time  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Arr_Date  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Arr_Time
							
							</div>
							<div class='col-sm-1'>
								Airlines_Name
							</div>
					
						</div>
					</div>
				</div>
				
				
				
				";
            if ($retval->num_rows > 0) {
				while($row = mysqli_fetch_array($retval2, MYSQL_ASSOC))
				{
					$Flight_ID = $row['FLIGHT_ID'];
				$From_Airport = $row['FROM_AIRPORT_CODE'];
				$To_Airport = $row['TO_AIRPORT_CODE'];
				$Baggage_Counter= $row['No_of_passenger'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];


				echo "
				<div class='table table-striped' style='margin:30px 0px; color:#f23914;'>
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
							<div class='col-sm-1'>
								$Baggage_Counter<br />
							</div>
							<div class='col-sm-5'>
								$Dept_Date	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	$Dept_Time  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  $Arrival_Date  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $Arrival_Time<br />
							
							</div>
							<div class='col-sm-1'>
								$Airlines_Name<br />
							</div>
					
						</div>
					</div>
					
				</div>
				
				
				
				";

				}
				
				echo "
				<div style='margin:30px 0px;color:black;'>
					<h4>After Update</h4><br />
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-1 col-sm-offset-1'>
								Flight_ID
							</div>
							<div class='col-sm-1'>
								From_Airport
							</div>
							<div class='col-sm-1'>
								To_Airport
							</div>
							<div class='col-sm-1'>
								No. of Passengers
							</div>
							<div class='col-sm-5'>
								Dept_Date	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	Dept_Time  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Arr_Date  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Arr_Time
							
							</div>
							<div class='col-sm-1'>
								Airlines_Name
							</div>
					
						</div>
					</div>
				</div>
				
				
				
				";
				while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
				{
					$Flight_ID = $row['FLIGHT_ID'];
				$From_Airport = $row['FROM_AIRPORT_CODE'];
				$To_Airport = $row['TO_AIRPORT_CODE'];
				$Baggage_Counter= $row['No_of_passenger'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];


				echo "
				<div class='table table-striped' style='margin:30px 0px; color:green;'>
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
							<div class='col-sm-1'>
								$Baggage_Counter<br />
							</div>
							<div class='col-sm-5'>
								$Dept_Date	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	$Dept_Time  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  $Arrival_Date  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $Arrival_Time<br />
							
							</div>
							<div class='col-sm-1'>
								$Airlines_Name<br />
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
            

			?>
			<div class="container">
				<div class="row well">
				
					<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
							<input type='number' id = "Name" name='Name'   placeholder="No. of Passenger" required><br />
						<br/>
						<input type='text' id = "Name1" name='Name1' placeholder="FLIGHT ID" required><br />
						<br/>
							
							
							<button id = "add1" name = "add1" type="submit" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Update Number of Passenger
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