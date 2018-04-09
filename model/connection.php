<?php
class DBConnection  
{
    private function openDb() 
    {
        $conn = mysqli_connect("localhost", "root", "");
        if (!$conn) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysqli_select_db($conn, "contacts")) {
            throw new Exception("No contacts database found on database server.");
        }
    }
}
?>