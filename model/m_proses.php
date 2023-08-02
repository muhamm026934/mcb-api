<?php
    class Db_table{
        protected $tb_user = 'tb_user';
        protected $tb_book = 'tb_book';
        protected $tb_stock_book = 'tb_stock_book';
        protected $tb_transaction = 'tb_transaction';
        protected $tb_kajian = 'tb_kajian';
        protected $tb_absensi = 'tb_absensi';
                      
		protected $sql_select_distinct = "SELECT DISTINCT ";
		protected $sql_select = "SELECT * FROM ";
		protected $sql_insert = "INSERT INTO ";
		protected $sql_update = "UPDATE ";
		protected $sql_delete = "DELETE FROM ";
		protected $sql_select_count = "SELECT COUNT"; 
        protected $sql_select_sum = "SELECT SUM";    
    }

    class Proses_sql extends Db_table{
        private $mysqli;
        
        function __construct($conn){
            $this->mysqli = $conn;
        }

        public function login(
            $username = null,
            $pasword = null){
            if ($username != null && $pasword != null) {
                $table = $this->tb_user;
                $select = $this->sql_select;                
                $sql = $select;	
                $sql.= $table;
                $sql.= " WHERE username = ? AND password = ?";
                $db = $this->mysqli->conf;
                $query = $db->prepare($sql) or die($db->error);
                $query->bind_param("ss",$username,$pasword); 
                if ($query->execute()) {
                    $result = $query->get_result();
                }                           
            }		
            return @$result;
        }     
// Tabel User
        public function data_user($id_user = null, $name = null){
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $select = $this->sql_select;
            $sql= $select;
            $sql.= $table;
            if (@$id_user != null || @$id_user != "") {
                $sql.= " WHERE id_user = '$id_user' ";
            }elseif (@$name != null || @$name != "") {
                $sql.= " WHERE name = '$name' ";
            }else {
                $sql.= " ORDER BY name ASC";
            }
            $query = $db->query($sql) or die($db->error);
            return $query;
        }

        public function add_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $insert = $this->sql_insert;
            $sql = $insert;
            $sql.= $table;
            $sql.= " SET 
            id_user = '',
            name = '$name',
            username = '$username',
            password = '$password',
            address = '$address',
            level = '$level',
            email = '$email',
            no_telp = '$no_telp',
            token = '$token'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

        public function edit_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $update = $this->sql_update;
            $sql = $update;
            $sql.= $table;
            $sql.= " SET 
            name = '$name',
            username = '$username',
            password = '$password',
            address = '$address',
            level = '$level',
            email = '$email',
            no_telp = '$no_telp',
            token = '$token'
            WHERE id_user = '$id_user'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

        public function delete_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $delete = $this->sql_delete;
            $sql = $delete;
            $sql.= $table;
            $sql.= " WHERE id_user = '$id_user'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }

// Kajian
        public function add_kajian(
            $id_kajian = null,
            $nm_kajian = null,
            $foto_kajian = null,
            $jam_start_kajian = null,
            $jam_end_kajian = null,
            $tgl_kajian = null            
            ){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_kajian;
            $insert = $this->sql_insert;
            $sql = $insert;
            $sql.= $table;
            $sql.= " SET 
            id_kajian = '',
            nm_kajian = '$nm_kajian',
            foto_kajian = '$foto_kajian',
            jam_start_kajian = '$jam_start_kajian',
            jam_end_kajian = '$jam_end_kajian',
            tgl_kajian = '$tgl_kajian'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }         
        public function data_kajian(
            $id_kajian = null,
            $nm_kajian = null,
            $foto_kajian = null,
            $jam_start_kajian = null,
            $jam_end_kajian = null,
            $tgl_kajian = null               
            ){
            $db = $this->mysqli->conf;
            $table = $this->tb_kajian;
            $select = $this->sql_select;
            $sql= $select;
            $sql.= $table;
            if (@$id_kajian != null || @$id_kajian != "") {
                $sql.= " WHERE id_kajian = '$id_kajian' ";
            }elseif (@$nm_kajian != null || @$nm_kajian != "") {
                $sql.= " WHERE nm_kajian = '$nm_kajian' ";
            }elseif (@$foto_kajian != null || @$foto_kajian != "") {
                $sql.= " WHERE foto_kajian = '$foto_kajian' ";
            }elseif (@$tgl_kajian != null || @$tgl_kajian != "") {
                $sql.= " WHERE tgl_kajian = '$tgl_kajian' ";
            }else {
                $sql.= " ORDER BY nm_kajian ASC";
            }
            $query = $db->query($sql) or die($db->error);
            return $query;
        }
        public function edit_kajian(
            $id_kajian = null,
            $nm_kajian = null,
            $foto_kajian = null,
            $jam_start_kajian = null,
            $jam_end_kajian = null,
            $tgl_kajian = null               
            ){

            $db = $this->mysqli->conf;
            $table = $this->tb_kajian;
            $update = $this->sql_update;
            $sql = $update;
            $sql.= $table;
            $sql.= " SET 
            nm_kajian = '$nm_kajian',
            foto_kajian = '$foto_kajian',
            jam_start_kajian = '$jam_start_kajian',
            jam_end_kajian = '$jam_end_kajian',
            tgl_kajian = '$tgl_kajian'            
            WHERE id_kajian = '$id_kajian'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }          
        public function delete_kajian(
            $id_kajian = null,
            $nm_kajian = null,
            $foto_kajian = null,
            $jam_start_kajian = null,
            $jam_end_kajian = null,
            $tgl_kajian = null               
            ){

            $db = $this->mysqli->conf;
            $table = $this->tb_kajian;
            $delete = $this->sql_delete;
            $sql = $delete;
            $sql.= $table;
            $sql.= " WHERE id_kajian = '$id_kajian'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

// Absensi

        public function add_absensi(
            $id_absensi = null,
            $id_kajian = null,
            $id_user = null,
            $datetime_absen = null
            ){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_absensi;
            $insert = $this->sql_insert;
            $sql = $insert;
            $sql.= $table;
            $sql.= " SET 
            id_absensi = '',
            id_kajian = '$id_kajian',
            id_user = '$id_user',
            datetime_absen = '$datetime_absen'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        } 

        public function data_absensi(
            $id_absensi = null,
            $id_kajian = null,
            $id_user = null,
            $datetime_absen = null
            ){
            $db = $this->mysqli->conf;
            $table = $this->tb_absensi;
            $select = $this->sql_select;
            $sql= $select;
            $sql.= $table;
            if (@$id_absensi != null || @$id_absensi != "") {
                $sql.= " WHERE id_absensi = '$id_absensi' ";
            }elseif (@$id_kajian != null || @$id_kajian != "") {
                $sql.= " WHERE id_kajian = '$id_kajian' ";
            }elseif (@$id_user != null || @$id_user != "") {
                $sql.= " WHERE id_user = '$id_user' ";
            }else {
                $sql.= " ORDER BY id_kajian ASC";
            }
            $query = $db->query($sql) or die($db->error);
            return $query;
        }   
        
        public function data_absensi_cek(
            $id_absensi = null,
            $id_kajian = null,
            $id_user = null,
            $datetime_absen = null
            ){
            $db = $this->mysqli->conf;
            $table = $this->tb_absensi;
            $select = $this->sql_select;
            $sql= $select;
            $sql.= $table;
            if (@$id_kajian != "" || @$id_user != "") {
                $sql.= " WHERE id_kajian = '$id_kajian' AND id_user = '$id_user' ";
            }else {
                $sql.= " ORDER BY id_kajian ASC";
            }
            $query = $db->query($sql) or die($db->error);
            return $query;
        }          

        public function edit_absensi(
            $id_absensi = null,
            $id_kajian = null,
            $id_user = null,
            $datetime_absen = null
            ){

            $db = $this->mysqli->conf;
            $table = $this->tb_absensi;
            $update = $this->sql_update;
            $sql = $update;
            $sql.= $table;
            $sql.= " SET 
            id_kajian = '$id_kajian',
            id_user = '$id_user',
            datetime_absen = '$datetime_absen'
            WHERE id_absensi = '$id_absensi'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

        public function delete_absensi(
            $id_absensi = null,
            $id_kajian = null,
            $id_user = null,
            $datetime_absen = null
            ){

            $db = $this->mysqli->conf;
            $table = $this->tb_absensi;
            $delete = $this->sql_delete;
            $sql = $delete;
            $sql.= $table;
            $sql.= " WHERE id_absensi = '$id_absensi'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }         
        
        function __destruct()
        {
            $db = $this->mysqli->conf;
            $db = $db->close();
        }
    }
?>