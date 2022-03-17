<?php

session_start();
//error_reporting(E_ALL & ~E_NOTICE); 


if(isset($_SESSION['loggedin'])){

require_once "config.php";

    $start = $end = "";
    $start_err = $end_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["start"]))){
        $start_err = "Uzupełnij datę";
    } else if($_POST["start"] < date("Y-m-d")){
        $start_err = "Data początkowa nie może być mniejsza od dzisiejszej";
    } else{
        $start = trim($_POST["start"]);
    }
    
    if(empty($_POST["end"])){
        $end_err = "Uzupełnij datę";
    } else if($_POST["end"] <= $_POST["start"]){
        $end_err = "Data końcowa musi być wyższa od początkowej";
    } else{
        $end = $_POST["end"];
    } 
    
    if(empty($end_err) && empty($start_err)){
        
        $carid = $_SESSION["selectedcar"];
        $userid = $_SESSION["userid"];

        $sql = "UPDATE cars SET user_id = $userid, rentalstart = '$start', rentalend = '$end' WHERE id = $carid";
        
        if($results = $link->query($sql)){
            
            header("location: display_car.php");
            
        }
        else{
            
            $date_err = "Błąd bazy danych";
            
        }
        
    }
}
    mysqli_close($link);
}
else{
    
    header("url: login.php");
    
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
        <link rel="stylesheet" href="../CSS/loginregister.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <style type="text/css">
    </style>
</head>
<body class="body_load">
    
    <a href="rental_car.php"><img class="back_arrow" src="../images/downarrow.png"></a>
    
    <div class="wrapper">
        
        
        <table>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <tr><td><h2>Wynajem</h2></td></tr>
            <tr>
                <tr><td><label>Data rozpoczęcia:</label><span class="help-block"><?php echo $start_err; ?></span></td></tr>
                <tr><td><input type="date" name="start" value="<?php echo $start; ?>"></td>
            </tr>
            <tr>
                <tr><td><label>Data zakończenia:</label><span class="help-block"><?php echo $end_err; ?></span></td></tr>
                <tr><td><input type="date" name="end" value="<?php echo $end; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Rozpocznij!"></td>
            </tr>
            
        </form>
            <tr></tr>
            <tr></tr>
        </table>
    </div>
    
    <div class="style_block_top"></div>
    <div class="style_block_bot"></div>
    </body>
   
</html>