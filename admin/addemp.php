<!DOCTYPE html>
<html>
<head>
   <!-- Title Page-->
    <title>Add Employee | Admin Panel</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <style>
    /* Page layout */

body {
    background-color: #f2f2f2;
    font-family: 'Roboto', sans-serif;
}

header {
    background-color: #990000;
    color: #ffffff;
    height: 60px;
    padding: 20px;
}

#navli {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

#navli li {
    float: left;
}

#navli li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

#navli li a:hover {
    background-color: #111;
}

.divider {
    border-bottom: 1px solid #ccc;
    margin-top: 20px;
    margin-bottom: 20px;
}

.page-wrapper {
    margin-top: 30px;
}

/* Form styling */

.card {
    border-radius: 5px;
    box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.card-body {
    padding: 40px;
}

.title {
    font-size: 24px;
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 20px;
}

.input--style-1 {
    background: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0;
    padding: 10px 0;
    width: 100%;
    color: #555;
    font-size: 16px;
}

.input--style-1::-webkit-input-placeholder {
    color: #999;
}

.input--style-1::-moz-placeholder {
    color: #999;
    opacity: 1;
}

.input--style-1:-ms-input-placeholder {
    color: #999;
}

.input--style-1:-moz-placeholder {
    color: #999;
    opacity: 1;
}

.btn--radius {
    border-radius: 5px;
}

.btn--green {
    background-color: #990000;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.btn--green:hover {
    background-color: #ff4d4d;
}

/* Responsive */

.wrapper {
    width: 100%;
    max-width: 680px;
    margin: 0 auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.row:before,
.row:after {
    content: " ";
    display: table;
}

.row:after {
    clear: both;
}

.col-2 {
    flex-basis: 50%;
    max-width: 50%;
    padding-right: 15px;
    padding-left: 15px;
}

/* Media queries */

@media (max-width: 768px) {
    .wrapper {
        max-width: 100%;
        padding: 0 20px;
    }

    .col-2 {
        flex-basis: 100%;
        max-width: 100%;
    }
}
</style>
</head>

<body>
    <header>
        <nav>
            <h1>NEWS KARKALA</h1>
            <ul id="navli">
                <li><a class="homeblack" href="dashboard.php">HOME</a></li>
                <li><a class="homered" href="addemp.php">ADD EMPLOYEE</a></li>
                <li><a class="homeblack" href="viewemp.php">VIEW EMPLOYEE</a></li>
                <li><a class="homeblack" href="../logout.php">LOGOUT</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>
<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">REGISTRATION INFORMATION</h2>
                    <form action="../process/addempprocess.php" method="POST" enctype="multipart/form-data">


                        

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="First Name" name="firstName" required="required" pattern="[A-Za-z ]+" title="Only characters are allowed">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
<input class="input--style-1" type="text" placeholder="Last Name" name="lastName" required="required" pattern="[A-Za-z\s]+" title="Only characters and spaces are allowed">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="Enter Email Address" name="email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$"  required="required" title="Email should be in proper format and end with @gmail.com."/>
                        </div>
                        <p>Birthday</p>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="BIRTHDATE" name="birthday" required="required">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender" required>
                                            <option disabled="disabled" selected="selected">GENDER</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                        <input class="input--style-1" type="tel" placeholder="Contact Number" name="contact" required="required" pattern="[0-9]{10}" title="Please enter a 10-digit contact number">


                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Password" name="password" required="required">
                        </div>
                        
                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Address" name="address" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Department" name="dept" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Salary" name="salary" required>
                        </div>

                        <div class="input-group">
                            <!-- <input class="input--style-1" type="file" placeholder="file" name="file">\ -->
                            <input type="file" id="image" name="file" accept="image/jpg, image/jpeg, image/png, image/pdf, image/document, image/docx" onblur="validateFileInput()"/>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script>
        function validateFileInput(fileInput) {
  // Get the file name.
  var file = fileInput.value;

  // Check if the file name already exists in the list of existing files.
  var existingFiles = document.getElementById("existingFiles").files;
  for (var i = 0; i < existingFiles.length; i++) {
    if (existingFiles[i].name === file) {
      // The file name already exists.
      return false;
    }
  }

  // The file name does not exist.
  return true;
}


    </script>    

</body>

</html>
<!-- end document-->
