<?php
@include '../config.php';
include_once ("../controller.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Service section</title>
        <link rel="stylesheet" type="text/css" href="bookingx.css">

    </head>
    <body>
        <div class="full-page">
            <div class="navigation-bar">
                <img src="bgi3.png " class="hello">
                    <a href="index.html"></a>
                
                <nav>
                    <ul id="MenuItems">
                        <li><a href="../index.html">HOME</a></li>
                        <li><a href="../website/user_page.php">PROFILE</a></li>
                        <li><a href="status.php">STATUS</a></li>
                        <li><a href="../feed/feedindex.php">FEEDBACK</a></li>
                        <li><a href="../logout.php">LOGOUT</a></li>
                    </ul>
                </nav>
                </div>
            </div>
            
        </div>
        
    </body>
    
    <body>
        <div class="container">
            <div class="box" style="--clr:#ed1f1f;">
                <div class="content">
                    <div class="icon"><ion-icon name="logo-youtube"></ion-icon>
                    </div>
                        <div class="text">
                            <h3>Youtube Streaming</h3>
                            <p>Youtube Services</p>
                            <a href="bookings.php">Book Now</a>
                                         
                        </div>
                    </div>
                </div>
                <div class="box" style="--clr:#d3d635;">
                    <div class="content">
                        <div class="icon"><ion-icon name="albums-outline"></ion-icon>
                        </div>
                            <div class="text">
                                <h3>Advertisements</h3>
                                <p>Advertisement Services</p>
                                <a href="bookingad.php">Book Now</a>
                                             
                            </div>
                        </div>
                </div>
                <div class="box" style="--clr:#5b98eb;">
                    <div class="content">
                        <div class="icon"><ion-icon name="book-outline"></ion-icon>
                        </div>
                            <div class="text">
                                <h3>Article Writting</h3>
                                <p>Article writting Services</p>
                                <a href="bookings3.php">Book Now</a>
                                             
                            </div>
                        </div>
                </div>
        
        
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
         <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>