<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        @$action = $_POST['ACTION'];
        @$id_kajian = $_POST['id_kajian'];
        @$nm_kajian = $_POST['nm_kajian'];

        @$data_kajian = $data->data_kajian(
            @$id_kajian,
            @$nm_kajian,
            @$foto_kajian
        ); 

            while ($row_kajian = $data_kajian->fetch_object()) {
                if (isset($row_kajian)) {
                $id_kajian = $row_kajian->id_kajian;
                $nm_kajian = $row_kajian->nm_kajian;
                $foto_kajian = $row_kajian->foto_kajian;

                }else{
                $id_kajian = "";	
                $nm_kajian = "";	
                $foto_kajian = "";
                }
            $b['id_kajian'] = $id_kajian; 
            $b['nm_kajian'] = $nm_kajian; 
            $b['foto_kajian'] = $foto_kajian;

            array_push($result, $b);

        }
        echo json_encode($result);
    }
?>