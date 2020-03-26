<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PeopleDB
 *
 * @author kenia
 */
class PeopleDB {
    public $mysqli;
    const LOCALHOST = 'mydbinstance.c9wgfwcl5exx.us-east-2.rds.amazonaws.com';
    const USER = 'root';
    const PASSWORD = 'rootroot';
    const DATABASE = 'cdp_db';
    
    /**
     * Constructor de clase
     */
    /*public function __construct() {
        try{
            echo "lol";
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión

            http_response_code(500);
            exit;
        }
    } */
    
    /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
   /* public function getPeople($id=0){
        $stmt = $this->mysqli->prepare("SELECT * FROM tb_user WHERE id=? ; ");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }*/
    
    /**
     * obtiene todos los registros de la tabla "people"
     * @return Array array con los registros obtenidos de la base de datos
     */
public function getPeoples(){


    $mysql = mysqli_connect("localhost","cdp_app","cdp2014", "cdp_db1");

    if(!$mysql)
    {
        echo "NO SE HA ESTABLECIDO CONEXION CON LA BASE DE DATOS.";
    }else
    {

        $result = mysqli_query($mysql, 'SELECT * FROM tb_user');

        $people1 =  array();
        while($peoples= mysqli_fetch_assoc($result)){
            $people1[] = $peoples;
        }
        return $people1;
        mysqli_close($mysql);
    }

     if (mysqli_connect_errno())
     {
         die(printf('MySQL Server connection failed: %s', mysqli_connect_error()));
     }

}
    
    /**
     * añade un nuevo registro en la tabla persona
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE 
     */
    /*public function insert($name=''){
        $stmt = $this->mysqli->prepare("INSERT INTO people(name) VALUES (?); ");
        $stmt->bind_param('s', $name);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
   /*public function delete($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM people WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * Actualiza registro dado su ID
     * @param int $id Description
     */
   /* public function update($id, $newName) {
        if($this->checkID($id)){
            $stmt = $this->mysqli->prepare("UPDATE people SET name=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $newName,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    /*public function checkID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE ID=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }*/
}
