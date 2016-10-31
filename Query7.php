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
      <title>Add New Record in MySQL Database</title>
   </head>
   
   <body>
      <?php
	  
         
            
			include('Admin_info.php');
			include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
			
            $sql = "SELECT *FROM AIRPORTS WHERE AIRPORT_CODE=(SELECT AIRPORT_CODE FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
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
         
      ?>
   
   </body>
</html>