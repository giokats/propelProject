<?php
require 'vendor/autoload.php'; 
require 'model/connection.php';

//use dbmodels\mycontacts\mycontacts\Contacts;
//use dbmodels\mycontacts\mycontacts\ContactsQuery;
/**
 * Table data gateway.
 * 
 *  OK I'm using old MySQL driver, so kill me ...
 *  This will do for simple apps but for serious apps you should use PDO.
 */
class ContactsGateway {
    
    public function selectAll($order, $conn) {
        // if ( !isset($order) ) {
        //     $order = "name";
        // }
        // $dbOrder =  mysqli_real_escape_string($conn, $order);
        // $dbres = mysqli_query($conn, "SELECT * FROM contacts ORDER BY $dbOrder ASC");
        
        // $contacts = array();
        // while ( ($obj = mysqli_fetch_object($dbres)) != NULL ) {
        //     $contacts[] = $obj;
        // }
        $contacts = ContactsQuery::create()->find();
        
        return $contacts;
    }
    
    public function selectById($id, $conn) {
        $dbId = mysqli_real_escape_string($conn, $id);
        
        $dbres = mysqli_query($conn, "SELECT * FROM contacts WHERE id=$dbId");
        
        return mysqli_fetch_object($dbres);
		
    }
    
    public function insert( $name, $phone, $email, $address, $conn ) {
        
        $dbName = ($name != NULL)?"'".mysqli_real_escape_string($conn, $name)."'":'NULL';
        $dbPhone = ($phone != NULL)?"'".mysqli_real_escape_string($conn,$phone)."'":'NULL';
        $dbEmail = ($email != NULL)?"'".mysqli_real_escape_string($conn,$email)."'":'NULL';
        $dbAddress = ($address != NULL)?"'".mysqli_real_escape_string($conn,$address)."'":'NULL';
        
        mysqli_query($conn, "INSERT INTO contacts (name, phone, email, address) VALUES ($dbName, $dbPhone, $dbEmail, $dbAddress)");
        return mysqli_insert_id();
    }
    
    public function delete($id, $conn) {
        $dbId = mysqli_real_escape_string($conn, $id);
        mysqli_query($conn, "DELETE FROM contacts WHERE id=$dbId");
    }
    
}

?>
