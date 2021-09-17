<?php

class db{

    private $connection;

    private $query_res;

    private $query;

    public function __construct()
    {
        $this->connection = mysqli_connect("localhost","root","","seniorschool");
    }

    public function select($table,$column){
        $this->query = "SELECT $column FROM `$table` ";
       return $this;
    }

    // where

    public function Where($column,$compair,$value){
        $this->query .=  " WHERE `$column` $compair '$value' ";
        return $this;
    }


    public function WhereAnd($column,$compair,$value){
        $this->query .=  "AND `$column` $compair '$value' ";
        return $this;

    }

    public function WhereOR($column,$compair,$value){
        $this->query .=  "OR `$column` $compair '$value' ";
        return $this;
    }

    public function excu(){
        // echo $this->query;die;
        $this->query_res =  mysqli_query($this->connection,$this->query);
    }
    // get data
    public function GetRow(){
        $this->excu();
        return mysqli_fetch_assoc($this->query_res); 
    }

    public function GetAll(){
        $this->excu();
        $data = [];
        while($row =  mysqli_fetch_assoc($this->query_res)){
            $data[] = $row;
        } 
        return $data;
    }

    public function insert($table,$data){
        $column = '';
        $value = '';
        foreach($data as $k => $v){
            $column .= "`$k` ,";
            $value .= " '$v' ,"; 
        }
        $column =  rtrim($column, ",");
        $value = rtrim($value , ",");

        $this->query = "INSERT INTO `$table` ($column) VALUES ($value)";
        $this->excu();
    }

    public function edit($table,$data){
        $column = '';
        foreach($data as $k => $v){
            $column .= "`$k`= '$v' ,";
        }
        $column =  rtrim($column, ",");

        $this->query = "UPDATE $table SET $column ";
        return $this;
    }

    public function delete($table){
        $this->query = "DELETE FROM `$table` ";
        return $this;
    }


    public function __destruct()
    {
        mysqli_close($this->connection);
    }
 

}