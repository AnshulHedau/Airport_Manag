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
            
            echo "Entered RETRIEVED successfully\n";

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


				echo "  <div style='margin:30px 0px;'>
				Flight_ID: $Flight_ID<br />
				From_Airport: $From_Airport<br />
				To_Airport: $To_Airport<br />
				Baggage_Counter: $Baggage_Counter<br />
				Dept_Date: $Dept_Date<br />
				Dept_Time: $Dept_Time<br />
				Arrival_Date: $Arrival_Date<br />
				Arrival_Time : $Arrival_Time<br />
				Airlines_Name : $Airlines_Name<br />
				Capacity : $Capacity<br />
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