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
	        padding-top: 0px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
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
            $ph = $_POST['password'];
            $Sx = $_POST['Name1'];
            $Sa = $_POST['Name2'];
            $Ss = $_POST['Name3'];
            $id = $_POST['Name4'];
            
			
            mysqli_select_db( $conn,'test_db');
            $sql2 = "SELECT *FROM ADMINS WHERE ADMIN='$User' AND PASSWORD='$Pass'";
            
            $retval2 =  mysqli_query( $conn , $sql2);
			while($row = mysqli_fetch_array($retval2, MYSQL_ASSOC))
				{
					$AIRPORT_CODE = $row['AIRPORT_CODE'];
				
				}
			$AIRPORT_COD=$AIRPORT_CODE;
			
            $sql = "insert into employee (AIRPORT_CODE, Name, Phone, Sex ,AGE, Shift, ID, Authority) value ('$AIRPORT_COD','$Code',$ph,'$Sx',$Sa,'$Ss','$id','AAA')";
            
            $retval =  mysqli_query( $conn , $sql);
			$sql1 = "Select * from employee where AIRPORT_CODE=(select AIRPORT_CODE from admins where Admin='$User' and Password='$Pass') and ID='$id';";
               
            $retvala =  mysqli_query( $conn , $sql1);
            
            if ($retvala->num_rows > 0) {

				echo "Entered RETRIEVED successfully<br />";
				while($row = mysqli_fetch_array($retvala, MYSQL_ASSOC))
				{
					$NAME = $row['Name'];
				$PHONE = $row['Phone'];
				$SEX = $row['Sex'];
				$AGE= $row['AGE'];
				$SHIFT= $row['Shift'];
				$ID= $row['ID'];
				$AUTHORITY= $row['Authority'];
				


				echo "  <div style='margin:30px 0px;'>
				Name: $NAME<br />
				Phone: $PHONE<br />
				Sex: $SEX<br />
				Age $AGE<br />
				Shift: $SHIFT<br />
				Id: $ID<br />
				Authority : $AUTHORITY<br />
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
							<input type='text' id = "Name" name='Name'/ placeholder="Employee Name" required><br />
						<br/>
							<input name = "password" type = "text" id = "password"/ placeholder="Employee Phone Number" required><br />
							
							<input type='text' id = "Name1" name='Name1'/ placeholder="Employee's Sex" required><br />
						<br/>
						<input type='text' id = "Name2" name='Name2'/ placeholder="Employee's Age" required><br />
						<br/>
						<input type='text' id = "Name3" name='Name3'/ placeholder="Employee's Shift" required><br />
						<br/>
						<input type='text' id = "Name4" name='Name4'/ placeholder="Employee's Id" required><br />
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
			</div>
			<script type="text/javascript" src="js/bootstrap.js"></script>
		
                 
            <?php
         }
      ?>
   
   </body>
</html>