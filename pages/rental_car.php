<?php

session_start();
error_reporting(E_ALL ^ E_NOTICE);

if(isset($_SESSION['loggedin'])){



}
else{

 header("location: login.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <link rel="stylesheet" href="../CSS/load.css">
        <link rel="stylesheet" href="../CSS/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <style type="text/css">
    </style>
</head>
<body class="body_load">
    <div class="style_block_top"></div>
    <div class="style_block_bot"></div>

    <a href="add_car.php"><img class="back_arrow" src="../images/downarrow.png"></a>

    <?php

        $userid = $_SESSION["userid"];

        if(isset($_POST['carid'])){

          $carid = $_POST["carid"];

        }

        if(isset($_SESSION['selectedcar'])){

            $carid = $_SESSION["selectedcar"];

        }

        $_SESSION["selectedcar"] = $carid;

        require_once 'config.php';

        $sql = "SELECT * FROM cars WHERE id like $carid";

        $results = mysqli_query($link,$sql);

        if(isset($_POST['carid']) or isset($_SESSION["selectedcar"])){

                    unset($_SESSION['no_car']);
                    $row = $results->fetch_assoc();


                    $id = $row["id"];
                    $make = $row["make"];
                    $model = $row["model"];
                    $capacity = $row["capacity"];
                    $year = $row["year"];
                    $power = $row["power"];

        }
        else{



            header("location: select_car.php");


        }
    ?>

<div id="car_param"><b>Marka:</b> <?php echo $make ?>&nbsp;&nbsp;&nbsp;<b>Model:</b> <?php echo $model ?>&nbsp;&nbsp;&nbsp;</div>

<img class='img_car' src="../images/car.png"><div id="car_mileage"><b>Rok:</b> <?php echo $year ?><br/> <b>Pojemność:</b> <?php echo $capacity ?><br/> <b>Moc:</b> <?php echo $power ?><br/></div>

<a href='add_rental.php'><img class='add_services' src='../images/nok.png'></a>

</body>

</html>
