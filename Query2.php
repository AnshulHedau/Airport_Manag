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
            

            ?>
            
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "400" border = "0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr>
                        <td width = "100">Airport Code</td>
                        <td><input name = "Code" type = "text" 
                           id = "Code"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Flight ID</td>
                        <td><input name = "id" type = "text" 
                           id = "id"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "add" type = "submit" id = "add" 
                              value = "Search">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            <?php
         }
      ?>
   
   </body>
</html>