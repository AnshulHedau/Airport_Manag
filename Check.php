<html>
   
   <head>
      <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PASSENGER DETAILS</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap1.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<style>
		body { background-image:url("AirporT1.png");
		background-repeat:no repeat;
		background-position:left top;
		background-size:cover;
		background-attachment:   fixed  ;
		color:white;
		
		text-align:center;
		font-family:Roboto;
		
	     
	        padding-top: 40px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
	      }

	      .form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
	        margin: 20px auto 20px;
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
            include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            if(! get_magic_quotes_gpc() ) {
               $pass_name = addslashes ($_POST['pass_name']);
			}else {
               $pass_name = $_POST['pass_name'];
               
            }
            
            $pnr_number = $_POST['pnr_number'];
            
            $sql = "SELECT FLIGHT_ID,A1.NAME as name1 ,A2.NAME as name2, BAGGAGE_COUNTER,DEPT_DATE,DEPT_TIME,ARRIVAL_DATE,ARRIVAL_TIME,Airlines_Name FROM (FLIGHTS JOIN AIRPORTS A1 ON FLIGHTS.FROM_AIRPORT_CODE=A1.AIRPORT_CODE) JOIN AIRPORTS A2 ON FLIGHTS.TO_AIRPORT_CODE=A2.AIRPORT_CODE WHERE FLIGHT_ID=(SELECT FLIGHT_ID FROM PASSENGER WHERE NAME='$pass_name' AND PNR='$pnr_number');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
            
            while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
			{
				$Flight_ID = $row['FLIGHT_ID'];
				$Departure_Airport = $row['name1'];
				$Arrival_Airport = $row['name2'];
				$Baggage_Counter= $row['BAGGAGE_COUNTER'];
				$Dept_Date= $row['DEPT_DATE'];
				$Dept_Time= $row['DEPT_TIME'];
				$Arrival_Date= $row['ARRIVAL_DATE'];
				$Arrival_Time = $row['ARRIVAL_TIME'];
				$Airlines_Name = $row['Airlines_Name'];

					echo "  <br /><div class='row'>
								<div class='col-md-10 col-md-offset-1' style='text-align:center;padding: 10px 0px;font-size:16px;border-style:solid;border-width:1px;background-color:#878383';>
									<h2>WELCOME $pass_name</h2>
									<h3> PNR NUMBER $pnr_number</h3>
									<br />
									<br />
									<div class='row'>
										<h4><div class='col-md-3 col-md-offset-1' style='text-align:left;'>
											Departure_Airport:<br /> <em>$Departure_Airport</em><br /><br />
											Dept_Date:<br /> <em>$Dept_Date</em> <br /><br />
											Dept_Time:<br /> <em>$Dept_Time</em> <br /><br />
										</div>
										<div class='col-md-3 col-md-offset-1' >
											Arrival_Airport:<br /> <em>$Arrival_Airport</em> <br /><br />
											Arrival_Date:<br /> <em>$Arrival_Date</em> <br /><br />
											Arrival_Time :<br /> <em>$Arrival_Time</em> <br /><br />
										</div>
										<div class='col-md-3' style='text-align:right;'>
											Flight_ID:<br /> <em>$Flight_ID</em> <br /><br />
											Baggage_Counter:<br /> <em>$Baggage_Counter</em> <br /><br />
											Airlines_Name:<br /> <em>$Airlines_Name</em><br /><br />
										</div>
								</h4>
									</div>
								</div>
							</div>
					";
				
				}
						}
				else {
					?>
					<h2>No Details Found....</h2><br>
					<?php
				}
            mysqli_close($conn);
         }
		 else {
            

            ?>
					<div class="container">
							<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
								<center>
									<h3 class="form-signin-heading" style="Color:black">Passenger Details</h3><br>
											
										<input type='text' id = "pass_name" name='pass_name'/ placeholder="Passenger Number" required><br />
										<input type='text' id = "pnr_number" name='pnr_number'/ placeholder="PNR NUMBER" required> <br />
										<button name="add" id="add" type="submit" class="btn btn-info">
											<i class="icon-ok icon-white"></i> Login
										</button>
										<button type="reset" class="btn">
											<i class="icon-refresh icon-black"></i> Clear
										</button>
								</center>
							</form>
					</div>
			
	
               
            <?php
         }
      ?>
   
   </body>
</html>