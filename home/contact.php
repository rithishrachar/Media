<?php
 include_once ("../controller.php");
?>


<!Doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Responsive Content Page</title>

        <script src="https://kit.fontawesome.com/f1a5209d4b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" href="contact.css">

    </head>
    <body>
        <section>
            <div class="navigation-bar">
                <nav>
                    <ul id="MenuItems">
                        <li><a href="../index.html">HOME</a></li>
                        <li><a href="gallary.html">GALARY</a></li>
                        <li><a href="services.html">SERVICES</a></li>
                        <li><a href="aboutus.html">ABOUT US</a></li>
                        <li><a href="../login/login_form.php">LOGIN</a></li>
                        <!-- <li><a href="login/login_form.php">Admin/Login</a></li> -->
                    
                    </ul>
                </nav>
            </div>
        </section>
        <section class="contact">
            <div class="content">
                <h2>Contact Us</h2>
                <p>News Karkala is a news streaming platform to rovide you with valid news about karkala and also provides you with services such as youtube streaming,advertisements and article writting </p>
            </div>
            <div class="container">
                <div class="contactInfo">
                    <div class="box">
                        <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            <div class="text">
                                <h3>Address</h3>
                                <p>574104 Taluk Ofiice Road,<br>Jayantinagara<br>234-567-678</p>
                            </div>
                        
                    </div>
                    <br>
                    <div class="box">
                        <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div class="text">
                                <h3>Phone</h3>
                                <p>8548034260</p>
                            </div>
                        
                    </div>
                    <br>
                    <div class="box">
                        <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <div class="text">
                                <h3>Email</h3>
                                <p>kulalprajwal65@gmail.com</p>
                            </div>
                        
                    </div>
                          
                </div>
                <br>
                <div class="contactForm">
                    <form method="post" action="contact.php" autocomplete="off">
                        <h2>Send Message</h2>
                        <div class="inputBox">
                            <input type="text" name="name" id="name" required="required">
                            <span>Full Name</span>
                        </div>
                        <div class="inputBox">
                            <input type="text" name="email" id="email" required="required">
                            <span>Email</span>
                        </div>
                        <div class="inputBox">
                            <textarea required="required" name="message" id="message"></textarea>
                            <span>Type Your Message.....</span>
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="contact" id="contact" value="Send">
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>