<?php

require_once "includes/dbh.inc.php";
session_start();
ini_set('display_errors', 0);
$ID = $_SESSION["id-number"];
$video = $_SESSION['videoURL'];
$id = $_SESSION['vID'];
$violation = $_SESSION['violation'];
$sql = "SELECT * FROM usersinfo WHERE badgeID = ('$ID')";
$results = mysqli_query($conn, $sql);
$badgeID = mysqli_fetch_array($results);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Violation Detector</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="/webapp/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            // Define a function to fetch data from server and update the web page
            function fetchData() {
                $.ajax({
                    url: "includes/online.data.inc.php",  // URL of the PHP script that retrieves data from database
                    dataType: "json",   // Data type expected from server
                    success: function(data) {
                        // Update the web page with the retrieved data
                        var html = "";
                        $.each(data, function(index, item) {
                            html += '<div class="block-weighted ml-2 mt-1">';
                            html += '<div class="weight-20">';
                            html += '<h3 class="h4-bold text-center">Details: </h3>';
                            html += '</div>';
                            html += '<div class="weight-80">';
                            html += '<p class=" h4">' + item.lastName + ', ' + item.badgeID + ' , ' + item.date_time + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="underline">';  
                            html += '</div>';
                        });
                        $("#data-container").html(html);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle errors if any
                        console.log("Error: " + textStatus + ": " + errorThrown);
                    }
                });
            }
            // Call the fetchData function every 5 seconds to update the web page
            setInterval(fetchData, 5000);
        });
    </script>
        <script>
        $(document).ready(function() {
            // Define a function to fetch data from server and update the web page
            function fetchData() {
                $.ajax({
                    url: "includes/data.inc.php",  // URL of the PHP script that retrieves data from database
                    dataType: "json",   // Data type expected from server
                    success: function(data) {
                        // Update the web page with the retrieved data
                        var html = "";
                        $.each(data, function(index, item) {
                            html += '<button class="status-button" data-id ="' + item.videoID + '">';
                            html += '<div class="block-hweighted block-weighted ml-2">';
                            html += '<div class="weight-20">';
                            html += '<h3 class="h4-bold text-center">Details: </h3>';
                            html += '</div>';
                            html += '<div class="weight-80">';
                            html += '<p class="h4">' + item.violation + ', ' + item.date_time + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="block-hweighted block-weighted ml-2 mb-1">';
                            html += '<div class="weight-20">';
                            html += '<h3 class="h4-bold text-center">Status: </h3>';
                            html += '</div>';
                            html += '<div class="weight-80">';
                            html += '<p class="h4">' + item.status + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</button>';
                            html += '<div class="underline">';
                        });
                        $("#data").html(html);
                        $(".status-button").click(function () {
                            var id = $(this).data("id");
                            window.location.href = "includes/user.details.inc.php?id=" + id;
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle errors if any
                        console.log("Error: " + textStatus + ": " + errorThrown);
                    }
                });
            }
            // Call the fetchData function every 5 seconds to update the web page
            setInterval(fetchData, 5000);
        });
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Lora:wght@400;500&family=Montserrat:ital,wght@0,200;0,400;0,500;1,400&family=Rubik:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        .center {
            padding: 2rem 0;
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body class="bg-whitee">
    <section class="top-nav">
        <div>
            <h2 class="h3-bold">Violation Detector</h2>
        </div>
        <input class="mt-1" id="menu-toggle" type="checkbox" />
        <label class='menu-button-container mt-1' for="menu-toggle">
        <div class='menu-button'></div>
      </label>
        <ul class="menu z-index">   
            <a href="./UserPage.php">Dashboard</a>
            <a href="./overspeeding.php">Overspeeding</a>
            <a href="./illegallane.php">Lane Change</a>
            <a href="./redlight.php">Red Light</a>
            <a href="./report.php">Report</a>
            <a href="includes/logout.inc.php">Logout</a>
        </ul>
      </section>
    <div class="wrapper">
        <div class="block-vweighted block-weighted mt-2">
            <div class="weight-50 block-vweighted " id="order-1">
                <div class="content-hcenter h-min-200 mb-2" >
                    <div class="user-info h-min-100">
                        <div class="content-hcenter h-min-100 bg-dark top-half">
                            <div class="">
                                <h1 class="h3-bold text-center text-white">Welcome Back!</h1>
                            </div>
                        </div>
                        <div class="block-weighted h-min-100">
                            <div class="weight-30 float-left">
                                <img class="w-70 m-1" src="images/dasma-logo.png">
                            </div>
                            <div class="weight-70">
                                <div class="block-weighted m-2">
                                    <div class="weight-50">
                                        <div class=" mx-2 mb-05">
                                            <label class="label-bold ">LAST NAME</label>
                                        </div>
                                        <div class=" mx-2 mb-05">
                                            <label class=" "><?php echo $badgeID[
                                                "lastName"
                                            ]; ?></label>
                                        </div>
                                    </div>
                                    <div class="weight-50">
                                        <div class=" mx-2 mb-05">
                                            <label class=" label-bold">FIRST NAME</label>
                                        </div>
                                        <div class=" mx-2 mb-05">
                                            <label class=" "><?php echo $badgeID[
                                                "firstName"
                                            ]; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-weighted mx-2">
                                    <div class="weight-50">
                                        <div class=" mx-2 mb-05">
                                            <label class="label-bold ">ID Number</label>
                                        </div>
                                        <div class=" mx-2 mb-05">
                                            <label class=" "><?php echo $badgeID[
                                                "badgeID"
                                            ]; ?></label>
                                        </div>
                                    </div>
                                    <div class="weight-50">
                                        <div class=" mx-2 mb-05">
                                            <label class=" label-bold">Phone Number</label>
                                        </div>
                                        <div class=" mx-2 mb-05">
                                            <label class=" "><?php echo $badgeID[
                                                "usersPnumber"
                                            ]; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-hcenter h-min-200 mb-2 mob-mb-2 " >
                    <div class="duty-info h-min-200" id="user_details">
                        <div class="content-hcenter h-min-100 top-half">
                        <div class="">
                            <h2 class="h3-bold text-center">On Duty</h2>
                        </div>
                        </div>
                        <div class="h-min-350" id="data-container">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="weight-50 mr-4 order-1 mob-m-0 mt-5o" id="order-2">
                <div class="content-hcenter h-min-200 mb-2" id="order-2">
                    <div class="logs-info h-min-200">
                        <div class="content-hcenter h-min-100 top-half">
                            <div class="">
                                <h2 class="h3-bold text-center">Logs</h2>
                            </div>
                        </div>
                        <div class="h-min-350" id="data">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script>

</script>

</html>