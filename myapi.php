<?php
 header("Content-type: application/json");

 $method = $_SERVER['REQUEST_METHOD'];

 switch($method){

       case 'GET':
        #code here
        handlegetOperation();
       break;


       case 'POST':
       #code here
       
       $data = json_decode(file_get_contents('php://input'), true); 
       handlepostOpaerration($data);
       break;


       case 'PUT':
        #code here
        $data = json_decode(file_get_contents('php://input'), true); 
        handlePutOperation($data);
        break;

       case 'DELETE':
            #code here
            $data = json_decode(file_get_contents('php://input'), true); 
            handleDeleteOperation($data);
       break;

       default:
       break;
 }


 //getOperation.....

 function handlegetOperation(){

    include "db.php";

    $sql = "SELECT * FROM testtable";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
      $rows = array();
       while($r = mysqli_fetch_assoc($result)) {
          $rows["result"][] = $r; // with result object
        //  $rows[] = $r; // only array
       }
      echo json_encode($rows);

    } else {
        echo '{"result": "No data found"}';
    }

  }



  
      //postOperation.....
  function handlepostOpaerration($data ){


    include "db.php";

    $name = $data["name"];
    $phone = $data["phone"];
 
    $sql = "INSERT INTO testtable(name, phone, datetime) VALUES('$name', '$phone' , NOW())";

    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }

  }


  //put oparation....

  function handlePutOperation($data){

    include "db.php";
  
    $id = $data["id"];
    $name = $data["name"];
    $phone = $data["phone"];
 
    
    $sql = "UPDATE testtable SET name = '$name', phone = '$phone',  datetime = NOW() WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }

  }




  function handleDeleteOperation($data){
    include "db.php";
  
    $id = $data["id"];
    
 
  
    $sql = "DELETE FROM testtable WHERE id = $id";


    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }

  }

  
?>