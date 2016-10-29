<?php
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
		<title>Admin Details</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap1.css">
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
		}
		</style>
      
   </head>
   
   <body>
      <?php
         
            
			
			include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
			
            $sql = "SELECT *FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass'";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            if ($retval->num_rows > 0) {

				while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
				{$NAME = $row['Admin'];
					$ANAME = $row['NAME'];
					$AIRPORT_CODE = $row['AIRPORT_CODE'];
					$AGE = $row['AGE'];
					$MOBILE_NUMBER= $row['MOBILE_NUMBER'];
					$EMAIL_ID= $row['EMAIL_ID'];
					
					echo "  <div class='row'>
								<div class='col-md-10 col-md-offset-1' style='text-align:center;padding: 10px 0px;font-size:16px;border-style:solid;border-width:1px;background-color:#676161';>
									<h2>Welcome $NAME</h2>
									<div class='row'>
										<div class='col-md-5 col-md-offset-1' style='text-align:left;'>
											AIRPORT_Name: $ANAME<br />
											AIRPORT_CODE: $AIRPORT_CODE<br />
										</div>
										<div class='col-md-5' style='text-align:right;'>
											<div class='airport' style:'float:right'>Age: $AGE<br />
											MOBILE_NUMBER: $MOBILE_NUMBER<br />
											MAIL_ID: $EMAIL_ID<br /></div>
											</div>
										</div>
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