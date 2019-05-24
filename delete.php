<?php
include_once('includes/db_connection.php');
$conn = OpenCon();


if(isset($_GET['id']))

{

     $sql = "DELETE FROM module_listing WHERE id=".$_GET['id'];

     $conn->query($sql);

	 echo 'Deleted successfully.';

}
CloseCon($conn);
?>