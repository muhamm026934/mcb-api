<?php
    class Dbs{
        private $host;        
        private $user;
        private $pass;
        private $db;
        public $conf;

        function __construct($host,$user,$pass,$db){
            $this->host=$host;
            $this->pass=$pass;
            $this->db=$db;
            $this->user=$user;

            $this->conf = new mysqli($this->host,$this->user,$this->pass,$this->db) or die (mysqli_error());

            if(!$this->conf) {
                return false;
            }else{
                return true;
            }

        }

    }
?>