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
      <title>Add New Record in MySQL Database</title>
   </head>
   
   <body>
      <?php
          {
					include('db_login.php');
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            
            
            $sql = "select employee.Name as Name,Phone,employee.Sex as Sex,employee.AGE as Age,employee.Shift as Shift,employee.ID as Id,employee.Authority as Authority from employee where employee.AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass');";
               
            mysqli_select_db( $conn,'test_db');
            $retval =  mysqli_query( $conn , $sql);
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            if ($retval->num_rows > 0) {
            echo "<div class='table table-striped' style='margin:30px 0px;'>
					<div class='container'>  	
						<div class='row'>
	    					<div class='col-sm-2 col-sm-offset-1'>
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
							</div>
					
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
				


				echo " <div class='table table-striped' style='margin:30px 0px; color:#f23914;'>
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
		
      ?>
   
   </body>
</html>