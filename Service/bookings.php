<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE-Edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>Responsive bookings form in html</title>
    <link rel="stylesheet" href="bookings.css"/>
    <style>
        /* Rest of your existing CSS styles */

/* Navbar styles */
.navbar {
  background-color: #333;
  height: 70px;
}

.nav-links {
  display: flex;
  /* justify-content: space-between; */
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-links li {
  margin: 0 30px;
}

.nav-links a {
  color: #fff;
  text-decoration: none;
}

.nav-links a:hover {
  color: #ccc;
}

        </style>
         <style>
        /* Rest of your existing CSS styles */
        .marquee {
            background-color: aqua;
            padding: 30px;
            cursor: pointer;
            /* Additional styling */
        }
    </style>
</head>
<body>
<nav class="navbar">
        <ul class="nav-links">
            <li><a href="bookingx.php">BACK</a></li>
            <li><a href="../logout.php">LOGOUT</a></li>
            <!-- <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li> -->
        </ul>
    </nav>
    <marquee class="marquee" behavior="scroll" direction="left" onclick="window.location.href='https://www.youtube.com/@newskarkala771/featured'">Click here to Visit Our YOUTUBE Channel</marquee>

    <section class="container">
        <header>YOUTUBE STREAMING</header>
        <form action="youtube.php" method="POST" class="form">
            <div class="input-box">
                <label for="name1">Name</label><span id="message1">*</span>
                <input type="text" id="name1" placeholder="Enter full name" name="name1" pattern="[A-Za-z ]+" onblur="validateName()" required/>
            </div>
            <div class="input-box">
                <label>Email Address</label><span id="message2">*</span>
                <input type="text" placeholder="Enter Email Address" name="email1" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" onblur="validateEmail()" readonly/>
            </div>
            <div class="input-box">
                <label>Date Of Event</label><span id="message3">*</span>
                <input type="date" id="ev_date" placeholder="Enter Date Of The Event" name="ev_date" onblur="validateDate()" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" />
                <span id="bookedMessage" style="color: red; display: none;">This date is already booked. Please select a different date.</span>
            </div>
            <div class="input-box">
                <label>Event</label><span id="message4">*</span>
                <input type="text" placeholder="Enter Name Of The Event" name="ev_name" required/>
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label><span id="message5">*</span>
                    <input type="text" placeholder="Enter Phone Number" name="number" pattern="[0-9]{10}" title="Phone number should contain 10 digits" required/>
                </div>
            </div>
            <div class="input-box">
                <label>Address</label><span id="message6">*</span>
                <input type="text" placeholder="Enter Address" name="address"required/>
                <label>Postal</label><span id="message7">*</span>
                <input type="number" placeholder="Enter Postal code" name="pincode" pattern="[0-9]{6}" title="Pin code should be of length 6"  required/>
            </div>
            <button id="submit">Submit</button>
        </form>
    </section>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        function validateName() {
            var nameInput = document.getElementById("name1");
            var valid = nameInput.checkValidity();

            if (!valid) {
                document.getElementById("message1").innerHTML = "Name should be in proper format (only alphabetic characters and spaces are allowed).";
                document.getElementById("submit").disabled = true;
            } else {
                document.getElementById("message1").innerHTML = "";
                document.getElementById("submit").disabled = false;
            }
        }

        function validateEmail() {
            var emailInput = document.querySelector('input[name="email1"]');
            var valid = emailInput.checkValidity();

            if (!valid) {
                document.getElementById("message2").innerHTML = "Email should be in proper format and end with @gmail.com.";
                document.getElementById("submit").disabled = true;
            } else {
                document.getElementById("message2").innerHTML = "";
                document.getElementById("submit").disabled = false;
            }
        }
 
        window.addEventListener('DOMContentLoaded', function() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var bookedDates = JSON.parse(xhr.responseText);
      var isDateBooked = false; // Flag to track if the selected date is booked

      // Disable booked dates in the date picker
      var dateInput = document.getElementById("ev_date");
      dateInput.addEventListener("input", function() {
        var selectedDate = new Date(this.value);
        var formattedSelectedDate = selectedDate.toISOString().split('T')[0];
        isDateBooked = false; // Reset the flag for each new selection

        for (var i = 0; i < bookedDates.length; i++) {
          var bookedDate = new Date(bookedDates[i]);
          var year = bookedDate.getFullYear();
          var month = String(bookedDate.getMonth() + 1).padStart(2, '0');
          var day = String(bookedDate.getDate()).padStart(2, '0');
          var formattedBookedDate = year + '-' + month + '-' + day;

          if (formattedSelectedDate === formattedBookedDate) {
            isDateBooked = true; // Set the flag if the selected date is booked
            break;
          }
        }

        if (isDateBooked) {
          document.getElementById("bookedMessage").style.display = "block";
          document.getElementById("submit").disabled = true;
        } else {
          document.getElementById("bookedMessage").style.display = "none";
          document.getElementById("submit").disabled = false;
        }
      });

      // Disable dates before today
      var currentDate = new Date();
      var formattedCurrentDate = currentDate.toISOString().split('T')[0];
      dateInput.setAttribute('min', formattedCurrentDate);

      // Form submit event listener
      var form = document.getElementById("ev_date"); // Replace "yourFormId" with the actual ID of your form
      form.addEventListener("submit", function(event) {
        if (isDateBooked) {
          event.preventDefault(); // Cancel the form submission if the date is already booked
        }
      });
    }
  };
  xhr.open('GET', 'get_booked_dates.php', true); // Replace 'get_booked_dates.php' with the actual path to your server-side script
  xhr.send();
});


        $('input[name="pincode"]').blur(function() {
    var value = $(this).val();

    if (value === "" || !/^[0-9]{6}$/.test(value)) {
        $('#message7').html(' Postal Code should contain 6 digits').css('color', 'red');
        $("#submit").prop('disabled', true);
    } else {
        $('#message7').html(' *').css('color', 'green');
        $("#submit").prop('disabled', false);
    }
});

    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var user = JSON.parse(xhr.responseText);
                    document.querySelector('input[name="name1"]').value = user.name;
                    document.querySelector('input[name="email1"]').value = user.email;
                }
            };
            xhr.open('GET', 'prepopulate_email.php', true); // Replace 'fetch_user_details.php' with your server-side script to retrieve user details
            xhr.send();
        });
    </script>
</body>
</html>
