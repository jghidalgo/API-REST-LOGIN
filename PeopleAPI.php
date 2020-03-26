<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PeopleAPI
 *
 * @author kenia
 */
require_once("PeopleDB.php"); 
class PeopleAPI {
    public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            $this->getPeoples();
           // echo 'OK';
            break;     
        case 'POST'://inserta
           // $this->savePeople();
            break;                
        case 'PUT'://actualiza
           // $this->updatePeople();
            break;      
        case 'DELETE'://elimina
            echo 'DELETE';
            break;
        default://metodo NO soportado
            echo 'METODO NO SOPORTADO';
            break;
        }
    }
    function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);  
        echo json_encode($response,JSON_PRETTY_PRINT);    
    }            
 }   
 function getPeoples(){
      if($_GET['action']=='login'){         
          $db = new PeopleDB();
         if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID                 
             $response = $db->getPeople($_GET['id']);                
             echo json_encode($response,JSON_PRETTY_PRINT);
         }else{ //muestra todos los registros                   
             $response = $db->getPeoples();              
             echo json_encode($response,JSON_PRETTY_PRINT);
         }
     }else{
            $this->response(400);
     }       
 }
 function savePeople(){
      if($_GET['action']=='peoples'){   
          //Decodifica un string de JSON
          $obj = json_decode( file_get_contents('php://input') );   
         //$objArr = (array)$obj;
        $objArr = [
        "id" => "3",
        "name" => "Joan",
        ];
          if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($objArr["name"])){
             $people = new PeopleDB();     
             $people->insert( $objArr["name"] );
             $this->response(200,"success","new record added");                             
         }else{
             $this->response(422,"error","The property is not defined");
         }
     } else{               
         $this->response(400);
     }  
 }
 function updatePeople() {
    if( isset($_GET['action']) && isset($_GET['id']) ){
        if($_GET['action']=='peoples'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj->name)){
                $db = new PeopleDB();
                $db->update($_GET['id'], $obj->name);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
    }
    $this->response(400);
}
}
