<?php
        require '../vendor/autoload.php';
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');
        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);

        @$action = $_POST['ACTION'];
        @$level = $_POST['level'];
        @$id_absensi = $_POST['id_absensi'];
        @$id_kajian = $_POST['id_kajian'];
        @$id_user = $_POST['id_user'];
        @$datetime_absen = $_POST['datetime_absen'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A2', 'No.');
        $sheet->setCellValue('B2', 'Judul Kajian');
        $sheet->setCellValue('C2', 'Nama');
        $sheet->setCellValue('D2', 'Tanggal Absensi');
        $no = 1;
        $row = 3;
        @$data_absensi = $data->data_absensi(
            @$id_absensi,
            @$id_kajian,
            @$id_user,
            @$datetime_absen
        ); 
        while ($row_absensi = $data_absensi->fetch_object()) {
            if (isset($row_absensi)) {
            $id_absensi = $row_absensi->id_absensi;
            $id_kajian = $row_absensi->id_kajian;
            $id_user = $row_absensi->id_user;
            $datetime_absen = $row_absensi->datetime_absen;

            }else{
            $id_absensi = "";	
            $id_kajian = "";	
            $id_user = "";
            $datetime_absen = "";                
            } 

            @$data_kajian = $data->data_kajian(
                @$id_kajian,
                @$nm_kajian,
                @$foto_kajian,
                @$jam_start_kajian,
                @$jam_end_kajian,
                @$tgl_kajian   
            ); 
            $row_kajian = $data_kajian->fetch_object();
            if (isset($row_kajian)) {
            $id_kajian = $row_kajian->id_kajian;
            $nm_kajian = $row_kajian->nm_kajian;
            $foto_kajian = $row_kajian->foto_kajian;
            $jam_start_kajian = $row_kajian->jam_start_kajian;
            $jam_end_kajian = $row_kajian->jam_end_kajian;
            $tgl_kajian = $row_kajian->tgl_kajian;

            }else{
            $id_kajian = "";	
            $nm_kajian = "";	
            $foto_kajian = "";
            $jam_start_kajian = "";	
            $jam_end_kajian = "";	
            $tgl_kajian = "";                       
            }

            @$data_user = $data->data_user(
                @$id_user,
                @$name
            );
                $row_user = $data_user->fetch_object();
                    if (isset($row_user)) {
                    $id_user = $row_user->id_user;
                    $name = $row_user->name;
                    $username = $row_user->username;
                    $password = $row_user->password;
                    $address = $row_user->address;
                    $level = $row_user->level;
                    $email = $row_user->email;
                    $no_telp = $row_user->no_telp;         
                    $token = $row_user->token;  
                    }else{
                    $id_user = "";	
                    $name = "";	
                    $username = "";
                    $password = "";
                    $address = "";	
                    $level = "";
                    $email = "";
                    $no_telp = "";
                    $token = "";
                    }

            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $nm_kajian);
            $sheet->setCellValue('C' . $row, $name);
            $sheet->setCellValue('D' . $row, $datetime_absen);

            $no++;
            $row++;
        }

        $sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("List Absensi");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="List Absensi.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

?>