<?php

require_once 'model/ContactsGateway.php';
require_once 'model/ValidationException.php';
require_once 'model/connection.php';
//require_once 'dbmodels/mycontacts/mycontacts/ContactsQuery.php';

require 'vendor/autoload.php'; 

use \mycontacts\mycontacts\Contacts;
use \mycontacts\mycontacts\ContactsQuery;

class ContactsService {
    
    private $contactsGateway    = NULL;

    private $conn;

    private $contactsPropel;
    
    // private function openDb() {
    //     $this->conn = mysqli_connect("localhost", "root", "");
    //     if (!$this->conn) {
    //         throw new Exception("Connection to the database server failed!");
    //     }
    //     if (!mysqli_select_db($this->conn, "contacts")) {
    //         throw new Exception("No contacts database found on database server.");
    //     }
    // }

    // public function getConn()
    // {
    //     return $this->conn;
    // }

    
    // private function closeDb() {
        
    //     mysqli_close($this->conn);
    // }
  
    //public function __construct() {
        //$this->contactsGateway = new ContactsGateway();
        //$this->contactsPropel = new ContactsQuery();
        //$this->openDb();
    //}
    
    public function getAllContacts($order) {
        try {
            //$this->openDb();
            //$res = $this->contactsGateway->selectAll($order, $this->conn);
            $res = ContactsQuery::create()->orderBy($order)->find();
            //var_dump(print_r($res,true));
            //$this->closeDb();
            return $res;
        } catch (Exception $e) {
            //$this->closeDb();
            throw $e;
        }
    }
    
    public function getContact($id) {
        try {
            //$this->openDb();
            //$res = $this->contactsGateway->selectById($id, $this->conn);
            //$this->closeDb();
            $res = ContactsQuery::create()->findPK($id);
            return $res;
        } catch (Exception $e) {
            //$this->closeDb();
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
            //$res = $this->contactsGateway->insert($name, $phone, $email, $address, $this->conn);
            $contact = new Contacts();
            $contact->setName($name);
            $contact->setPhone($phone);
            $contact->setEmail($email);
            $contact->setAddress($address);
            $contact->save();
            //$this->closeDb();
            return $contact;
        } catch (Exception $e) {
            //$this->closeDb();
            throw $e;
        }
    }

    public function editContact($id, $name, $phone, $email, $address ) {
        try{
            $contact = ContactsQuery::create()->findOneById($id);
            $contact->setName($name);
            $contact->setPhone($phone);
            $contact->setEmail($email);
            $contact->setAddress($address);
            $contact->save();

            return $contact;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function deleteContact( $id ) {
        try {
            //$this->openDb();
            //$res = $this->contactsGateway->delete($id, $this->conn);
            //$this->closeDb();
            $contact = ContactsQuery::create()->findOneById($id)->delete();

        } catch (Exception $e) {
            //$this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
