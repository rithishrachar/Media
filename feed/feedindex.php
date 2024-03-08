<html>
  <head>
  <style>
  
  /* Add your creative CSS styling here */
  body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
  }

  .navbar {
      background-color:aquamarine;
      color: #fff;
      display: flex;
      justify-content: space-between;
      padding: 10px;
  }

  .navbar h1 {
      margin: 0;
      font-size: 24px;
  }

  .navbar ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
  }

  .navbar ul li {
      margin-left: 10px;
  }

  .content {
      padding: 20px;
  }
  
</style>
  </head>
  <body>
  <div class="navbar">
        <h1>FEEDBACK FORM</h1>
        <ul>
            <li><a href="../Service/bookingx.php">HOME</a></li>
            <li><a href="../logout.php">LOGOUT</a></li>
            <!-- <li><a href="#">Contact</a></li> -->
        </ul>
    </div>
  </body>
</html>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/-->
<!DOCTYPE html>
<html>
<head>
<title>FeedbacK Engine</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elegant Feedback Form  Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="feedindex.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
</head>
<body class="agileits_w3layouts">
    <h1 class="agile_head text-center">Feedback Form</h1>
    <div class="w3layouts_main wrap">
	  <h3>Please help us to serve you better by taking a couple of minutes. </h3>
	    <form action="feedback.php" method="post" class="agile_form">
		  <h2>How satisfied were you with our Service?</h2>
			 <ul class="agile_info_select">
				 <li><input type="radio" name="view" value="Excellent" id="excellent" required> 
				 	  <label for="excellent">excellent</label>
				      <div class="check w3"></div>
				 </li>
				 <li><input type="radio" name="view" value="Good" id="good"> 
					  <label for="good"> good</label>
				      <div class="check w3ls"></div>
				 </li>
				 <li><input type="radio" name="view" value="Neutral" id="neutral">
					 <label for="neutral">neutral</label>
				     <div class="check wthree"></div>
				 </li>
				 <li><input type="radio" name="view" value="Poor" id="poor"> 
					  <label for="poor">poor</label>
				      <div class="check w3_agileits"></div>
				 </li>
			 </ul>	  
			<h2>If you have specific feedback, please write to us...</h2>
			<textarea placeholder="Additional comments" class="w3l_summary" name="comments" required=""></textarea>
            <input type="text" placeholder="Your Name (optional)" name="name" pattern="[A-Za-z]+" title="Please enter only characters" />
            <input type="email" placeholder="Your Email (optional)" name="email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" title="Please enter a valid Gmail address" />
            <input type="text" placeholder="Your Number (optional)" name="num" pattern="\d{10}" title="Please enter a 10-digit number" />
			<center><input type="submit" value="submit Feedback" class="agileinfo" /></center>
	  </form>
	</div>
	<!-- <div class="agileits_copyright text-center">
			<p>© 2019 </p>
	</div> -->
</body>
</html>

