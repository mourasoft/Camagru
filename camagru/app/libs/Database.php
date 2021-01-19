<?php
/*
 *
 * PDO Database Class
 * connect to database
 * create prepared statements
 * bind values
 * Return rows and results
 * 
 */

 class Database{
     private $host = DB_HOST;
     private $user = DB_USER;
     private $pass = DB_PASS;
     private $dbname = DB_NAME;


     private $dbh;
     private $stmt;
     private $error;
    
    public function __construct()
    {
        //set Dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Create PDO instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options)
            ;
        }catch(PDOException $e)
        {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    // Prepare statement with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // bind value
    public function bind($params, $value, $type = null){
        if(is_null($value)){
        switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
            break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
            break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
            break;
            default:
                $type = PDO::PARAM_STR;
        }
       }
       $this->stmt->bindValue($params, $value, $type);
    }
    //  execute the prepared statment
    public function execute(){
    return $this->stmt->execute();
    }
    // get result set as array of object
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get single row as object
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rewCount(){
        return $this->stmt->rewCount();
    }

 }