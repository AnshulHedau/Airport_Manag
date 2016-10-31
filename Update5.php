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
            
			$sql1 = "UPDATE `tutorial`.`AIRPORTS` SET `No._OF_RUNWAYS`='$Code' WHERE `AIRPORT_CODE`=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass');";
            mysqli_select_db( $conn,'test_db');
            $retval1 =  mysqli_query( $conn , $sql1);
			$sql = "SELECT *FROM AIRPORTS WHERE AIRPORT_CODE=(SELECT AIRPORT_CODE FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass');";
               
            $retval =  mysqli_query( $conn , $sql);
            if ($retval->num_rows > 0) {

				echo "<h1 style='color:black'> Airport Details</h1>";
				while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
				{
					$NAME = $row['NAME'];
					$AIRPORT_CODE = $row['AIRPORT_CODE'];
					$CITY = $row['CITY'];
					$TYPE= $row['TYPE'];
					$Runways= $row['No._OF_RUNWAYS'];
					$Terminals= $row['No._OF_TERMINALS'];
					echo "<div class='container' >
								<div class='row' style='margin:30px 0px;;color:black;'>
    								<h3><div class='col-sm-4'>
										Name: $NAME<br /><br />
										AIRPORT_CODE: $AIRPORT_CODE<br /><br />
										CITY: $CITY<br /><br />
										TYPE $TYPE<br /><br />
										
									</div></h3>
									
									<div class='col-sm-3 col-sm-offset-1' style='text-align:center;color:black;'>
										
										<img src='runways.png' height='100px' width='100px'>
										<br />
										<h1>Number of Runways: $Runways<br /></h1>
									</div>
									<div class='col-sm-4' style='text-align:center;;color:black;'>
										
										<img src='terminal.png' height='100px' width='100px'>
										
										<h1>Number of Terminals: $Terminals<br /></h1>
									</div>
								</div>
							</div>
					";

				}
						}
            
            mysqli_close($conn);
         }
		 else {
            
					include('style.php');
			?>
			<div class="container">
				<form class="form-signin" method = "post" action = "<?php $_PHP_SELF ?>">
						<center>
						<h3> Update No. of Runways </h3><br />
							<input type='Number' id = "Name" name='Name' min="1" max="10" placeholder="No. of Runways" required><br />
						<br/>
							
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