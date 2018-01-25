<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$con = new mysqli("localhost", "root", "", "carpool");
if ($con->error or $con->errno) {
    echo 'Error: ' . $con->error;
} else {
  // signup pade
  if (isset($_POST["username"])&& isset($_POST["email"]) &&isset($_POST["phoneno"])&&isset($_POST["pswd"])&&isset($_POST["dob"])) {
    $vusername = $_POST["username"];
    $vemail = $_POST["email"];
    $vphoneno = $_POST["phoneno"];
    $vpswd = $_POST["pswd"];
    $vdob = $_POST["dob"];
    $query = "INSERT INTO user( user_name, email, age, phone_no, password) VALUES ('$vusername','$vemail','$vdob','$vphoneno','$vpswd')";
    if ($res = $con->query($query)) {
      echo "registered succesfully";
    }
    else {
      echo $query;
    }
  }

//login
  if (isset($_POST['lusername']) && isset($_POST['lpswd'])) {
          if (1) {
              $vusernamel = $_POST['lusername'];
              $vuserpassl = $_POST['lpswd'];
               $query = "SELECT count(*) as 'sum' FROM user WHERE email='$vusernamel' and password='$vuserpassl'";
               $res0 = $con->query($query);
               if ($result = $res0->fetch_assoc()) {
                 if ($result['sum'] == 1) {
                       echo 'true';
                   } else {
                     echo 'false';
                   }
              } else {
                  echo 'false';
              }
              // echo "succes";
          }
      }

//rideoffer
      if (isset($_POST['userid']) && isset($_POST['car']) && isset($_POST['carno']) && isset($_POST['depart']) && isset($_POST['dropoff']) && isset($_POST['price']) && isset($_POST['detailfrom']) && isset($_POST['detailto']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['seats']) && isset($_POST['seats_a'])) {
        $vuserid = $_POST["userid"];
        $vcar = $_POST["car"];
        $vcarno = $_POST["carno"];
        $vdepart = $_POST["depart"];

        $vdropoff = $_POST["dropoff"];
        $vprice = $_POST["price"];
        $vdetailform = $_POST["detailfrom"];
        $vdetailto = $_POST["detailto"];

        $vdate = $_POST["date"];
        $vtime = $_POST["time"];
        $vseats = $_POST["seats"];
        $vseats_a = $_POST["seats_a"];
        // $query = "INSERT INTO user( user_name, email, age, phone_no, password) VALUES ('$vusername','$vemail','$vdob','$vphoneno','$vpswd')";
        $query = "INSERT INTO rides_a(user_id, car, carno, departure, dropoff, price, detailfrom, detailto, date_ , time, seats, seats_a) VALUES ('$vuserid','$vcar','$vcarno','$vdepart','$vdropoff','$vprice','$vdetailform','$vdetailto','$vdate','$vtime','$vseats','$vseats_a')";
        if ($res = $con->query($query)) {
          echo "registered succesfully";
        }
        else {
          echo $vcar;
        }
      }
}


// if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['date'])) {
//         if (1) {
//             // $vfrfrom = $_POST['from'];
//             // $vfrto = $_POST['to'];
//             // $vfrdate = $_POST['date'];
//             // $data = array();
//             // $query = "SELECT * FROM user WHERE 1";
//             // $res0 = $con->query($query);
//             // while ($result0 = $res0->fetch_assoc()) {
//             //     $data["zxy"] = $result0["email"];
//             //     $data["f"] = $vfrfrom;
//             //     $data["t"] = $vfrto;
//             //     $data["d"] = $vfrdate;
//             // }
//         }
//         echo "sdasd";
//         // echo json_encode($data);
//     }

    if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['date'])) {
                $data = array();
                $vfrfrom = $_POST['from'];
                $vfrto = $_POST['to'];
                $vfrdate = $_POST['date'];
                $data = [];
                // $query = "SELECT * FROM rides_a WHERE ride_a = '1'";
                $query = "SELECT * FROM rides_a WHERE ride_a = '1' AND departure = '$vfrfrom' AND dropoff = '$vfrto' AND date_ = '$vfrdate'";
                $res0 = $con->query($query);

                while ($result0 = $res0->fetch_assoc()) {
                $data[$result0["id"]]["car"] = $result0["car"];
                $data[$result0["id"]]["carno"] = $result0["carno"];
                $data[$result0["id"]]["dept"] = $result0["departure"];
                $data[$result0["id"]]["drop"] = $result0["dropoff"];
                $data[$result0["id"]]["price"] = $result0["price"];
                $data[$result0["id"]]["dfrom"] = $result0["detailfrom"];
                $data[$result0["id"]]["dto"] = $result0["detailto"];
                $data[$result0["id"]]["date"] = $result0["date_"];
                $data[$result0["id"]]["time"] = $result0["time"];
                $data[$result0["id"]]["seats_a"] = $result0["seats_a"];
                }
            echo json_encode($data);
        }
