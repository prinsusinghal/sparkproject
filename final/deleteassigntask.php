<?php
   include_once 'source/db_connect.php';
   include_once 'source/session.php';

   $id = $_GET['rn'];
   $query = "DELETE FROM assigntask WHERE id = $id";
   $result_delete =$conn->prepare($query);
   $result_delete->execute();

   if($result_delete)
   {
        echo '<script>alert("Task deleted Successfully!")</script>';
        header( "refresh:1;url=alltasks.php" );
   }
   else
   {
        echo '<script>alert("Task FAILED to delete!")</script>';
   }
?>