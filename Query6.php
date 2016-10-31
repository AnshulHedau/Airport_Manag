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
		<title>Flight Details</title>
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
            echo "
				<div style='margin:30px 0px;color:black;'>
					<div class='container'>  	
						<h2>Flight Details</h2>
						<div class='row'>
	    					<h5><div class='col-sm-1 col-sm-offset-1'>
								Flight_ID
							</div>
							<div class='col-sm-1'>
								From_Airport
							</div>
							<div class='col-sm-1'>
								To_Airport
							</div>
							<div class='col-sm-1'>
								Bag_Counter
							</div>
							<div class='col-sm-1'>
								Passengers
							</div>
							<div class='col-sm-1'>
								Dept_Date
							</div>
							<div class='col-sm-1'>
								Dept_Time
							</div>
							<div class='col-sm-1'>
								Arrival_Date
							</div>
							<div class='col-sm-1'>
								Arrival_Time
							</div>
							<div class='col-sm-1'>
								Airlines_Name
							</div></h5>
					
						</div>
					</div>
				</div>
				
				
				
				";            
            $sql = "SELECT * FROM FLIGHTS WHERE FROM_AIRPORT_CODE=(SELECT AIRPORT_CODE FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
			while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$Flight_ID = $row['FLIGHT_ID'];
				$From_Airport = $row['FROM_AIRPORT_CODE'];
				$To_Airport = $row['TO_AIRPORT_CODE'];
				$Baggage_Counter= $row['BAGGAGE_COUNTER'];
				$num = $row['No_OF_PASSENGERS'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];


				echo "
				<div style='margin:30px 0px; color:#000000;'>
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
							<div class='col-sm-1'>
								$num<br />
							</div>
							<div class='col-sm-1'>
								$Dept_Date<br />
							</div>
							<div class='col-sm-1'>
								$Dept_Time<br />
							</div>
							<div class='col-sm-1'>
								$Arrival_Date<br />
							</div>
							<div class='col-sm-1'>
								$Arrival_Time<br />
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
		      else if(isset($_POST['add1'])) {
				  include('Admin_info.php');
            include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            echo "
				<div style='margin:30px 0px;color:black;'>
					<div class='container'>  	
						<h2>Flight Details</h2>
						<div class='row'>
	    					<h5><div class='col-sm-1 col-sm-offset-1'>
								Flight_ID
							</div>
							<div class='col-sm-1'>
								From_Airport
							</div>
							<div class='col-sm-1'>
								To_Airport
							</div>
							<div class='col-sm-1'>
								Baggage Counter
							</div>
							<div class='col-sm-1'>
								Passengers
							</div>
							<div class='col-sm-1'>
								Dept_Date<br />
							</div>
							<div class='col-sm-1'>
								Dept_Time<br />
							</div>
							<div class='col-sm-1'>
								Arrival_Date<br />
							</div>
							<div class='col-sm-1'>
								Arrival_Time<br />
							</div>
							<div class='col-sm-1'>
								Airlines_Name
							</div></h5>
					
						</div>
					</div>
				</div>
				
				
				
				";

            
            $sql = "SELECT * FROM FLIGHTS WHERE TO_AIRPORT_CODE=(SELECT AIRPORT_CODE FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
            while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$Flight_ID = $row['FLIGHT_ID'];
				$From_Airport = $row['FROM_AIRPORT_CODE'];
				$To_Airport = $row['TO_AIRPORT_CODE'];
				$Baggage_Counter= $row['BAGGAGE_COUNTER'];
				$num= $row['No_OF_PASSENGERS'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];


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
							<div class='col-sm-1'>
								$Baggage_Counter<br />
							</div>
							<div class='col-sm-1'>
								$num<br />
							</div>
							<div class='col-sm-1'>
								$Dept_Date<br />
							</div>
							<div class='col-sm-1'>
								$Dept_Time<br />
							</div>
							<div class='col-sm-1'>
								$Arrival_Date<br />
							</div>
							<div class='col-sm-1'>
								$Arrival_Time<br />
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
		 
		 else if(isset($_POST['add2'])) {
			 include('Admin_info.php');
            include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
		if($User=='Anshul' && $Pass=='15BCE2079')
		{
            $sql = "SELECT FLIGHTS.FLIGHT_ID as FLIGHT_ID,FLIGHTS.DEPT_TIME as DEPT_TIME, TRANSIT.CHANGE_IN_PASSENGER_No as Passenger_Change FROM FLIGHTS NATURAL JOIN TRANSIT WHERE FROM_AIRPORT_CODE=(SELECT AIRPORT_CODE FROM ADMINS WHERE ADMIN='ANSHUL' AND PASSWORD='15BCE2079');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            
			
			echo"<div class='container' style='color:black'>  	
					<h2>Transit Details</h2><br />
					<h3><div class='row'>
    					<div class='col-sm-3 col-sm-offset-1'>
							Flight_ID<br />
						</div>
						<div class='col-sm-2 col-sm-offset-1'>
							Dept_Time<br />
						</div>
						<div class='col-sm-2 col-sm-offset-1'>
							Passenger_Change <br />
						</div>
				
					</div></h3>
				</div>
				";
			while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$Flight_ID = $row['FLIGHT_ID'];
				$Dept_Time= $row['DEPT_TIME'];
				$Passenger_Change =  $row['Passenger_Change'];
				


				echo "  
				
				<div class='container' style='color:black'>  	
					<div class='row'>
    					<div class='col-sm-3 col-sm-offset-1'>
							$Flight_ID<br />
						</div>
						<div class='col-sm-2 col-sm-offset-1'>
							$Dept_Time<br />
						</div>
						<div class='col-sm-2 col-sm-offset-1'>
							$Passenger_Change<br />
						</div>
				
					</div>
				</div>
				";


			}
		
		}
		else {
			?>
			<br />
			<br/>
			<br />
			<br />
			<h1 style="color:black">No TRANSIT Available</h1>
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
						<h2> FLIGHT DETAILS </h2>
						<br />
						<br />
							
							<button id = "add" name = "add" type="submit" value="Airline employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i> DEPARTURES
							</button>
							<br /><br />
							
							<button id = "add1" name = "add1" type="submit" value="Airport employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i> ARRIVALS
							</button>
							<br /><br />
							
							<button id = "add2" name = "add2" type="submit" value="Airport employee Search" class="btn btn-info">
								<i class="icon-ok icon-white"></i>TRANSITS
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