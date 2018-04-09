<?php

require_once 'model/ContactsGateway.php';
require_once 'model/ValidationException.php';
require_once 'model/connection.php';

class ContactsService {
    
    private $contactsGateway    = NULL;

    private $conn;
    
    private function openDb() {
        $this->conn = mysqli_connect("localhost", "root", "");
        if (!$this->conn) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysqli_select_db($this->conn, "contacts")) {
            throw new Exception("No contacts database found on database server.");
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

    // public function __construct(DBConnection $conn)
    // {
    //     $this->mysqli = $db->getLink();
    // }
    
    private function closeDb() {
        
        mysqli_close($this->conn);
    }
  
    public function __construct() {
        $this->contactsGateway = new ContactsGateway();
        $this->openDb();
    }
    
    public function getAllContacts($order) {
        try {
            //$this->openDb();
            $res = $this->contactsGateway->selectAll($order, $this->conn);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getContact($id) {
        try {
            //$this->openDb();
            $res = $this->contactsGateway->selectById($id, $this->conn);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id, $this->conn);
    }
    
    private function validateContactParams( $name, $phone, $email, $address ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewContact( $name, $phone, $email, $address ) {
        try {
            //$this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->insert($name, $phone, $email, $address, $this->conn);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function deleteContact( $id ) {
        try {
            //$this->openDb();
            $res = $this->contactsGateway->delete($id, $this->conn);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
