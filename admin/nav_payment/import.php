
<?php

//import.php

include './vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=project", "root", "");

if ($_FILES["import_excel"]["name"] != '') {
    $allowed_extension = array('xls', 'csv', 'xlsx');
    $file_array = explode(".", $_FILES["import_excel"]["name"]);
    $file_extension = end($file_array);

    if (in_array($file_extension, $allowed_extension)) {
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $reader->setLoadSheetsOnly(["Sheet 2", "all"]);
        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            if ($row[1] != 0) {

                $insert_data = array(
                    ':seq'  => $row[1],
                    ':book_name'  => $row[2],
                    ':year'  => $row[3],
                    ':month'  => $row[4],
                    ':house_id'  => $row[5],
                    ':book_number'  => $row[6],
                    ':number'  => $row[7],
                    ':date_paid'  => $row[8],
                    ':amount'  => $row[9],
                    ':other'  => $row[10]
                );

                $query = "
       INSERT INTO payment 
       (seq, book_name, year, month, house_id, book_number, number, date_paid, amount, other) 
       VALUES (:seq, :book_name, :year, :month, :house_id, :book_number, :number, :date_paid, :amount, :other)
       ";

                $statement = $connect->prepare($query);
                $statement->execute($insert_data);
            }
        }
        $message = '<div class="alert alert-success">Data Imported Successfully</div>';
    } else {
        $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
    }
} else {
    $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>
