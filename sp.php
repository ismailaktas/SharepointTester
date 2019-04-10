<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__) . "/sharepoint.php";

$fileName = $_FILES['txtFile']['tmp_name'];

$uploadFolder =  dirname ( __FILE__  ) . "/".project::uploadFolder;
$dosyaAdi = basename($_FILES['txtFile']['name']);
$yuklenecek_dosya = $uploadFolder . $dosyaAdi;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SP Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">


<?php
if (move_uploaded_file($_FILES['txtFile']['tmp_name'], $yuklenecek_dosya))
{

    try
    {
        $sp = new sharePoint(sp::sharepointListName);
        $sp->title = $dosyaAdi; 
        $sp->save();
        
        echo "<div class='alert alert-success' role='alert'>SHAREPOINT OK. <p>Dokuman ".sp::sharepointListName." Listesine Yüklendi.</p> </div>";
    }
    catch(exception $e)
    {
        echo "ERROR: ".var_dump($e->getMessage());
    }    

} else {
    echo "Dosya Upload Edilemedi";
}
?>

    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    

</body>
</html>