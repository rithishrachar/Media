<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE-Edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>Responsive bookings form in html</title>
    <link rel="stylesheet" href="bookingad.css"/>
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
            <li><a href="bookingx.php">Back</a></li>
            <li><a href="../logout.php">LogOut</a></li>
            <!-- <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li> -->
        </ul>
    </nav>
    <marquee class="marquee" behavior="scroll" direction="left"> Note: Cancellation of booking is not Possible. No refund beyond this point.</marquee>

        <section class="container">
            <header><h2><pre><u>ADVERTISEMENT BOOKING</u></pre></h2></header>
            <form action="advertisement.php" enctype="multipart/form-data" method="POST" class="form">
                <div class="input-box">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter full name" name="name3" onblur="validateName(this)" required/>

                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="text" placeholder="Enter Email Address" name="email3" onblur="validateEmail(this)" readonly/>

                </div>
                
                <div class="input-box">
                    <label>Phone Number</label>
                    <div>
                        <input type="number" placeholder="Enter Phone Number" name="number" onblur="validatePhoneNumber(this)" required/>
                    </div>
                </div>
                <div class="input-box">
                    
    <label>Advertisement Type</label>
    <div>
    <select name="title" required>
        <option value="" disabled selected>Select Advertisement Type</option>
        <option value="Commercial">Commercial</option>
        <option value="Personal">Personal</option>
    </select>
    </div>
</div>


                <div class="input-box">
                    <label>Description</label>
                    <input type="text" placeholder="Enter Description of Advertisement" name="artical" required/>
                </div>
                
                <div class="input-box">
                    <label>Upload File</label>
                    <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png" required>
                </div>

                <div class="input-box">
                    <label>Duration</label>
                    <input type="text" value="1 MONTH" name="duration" readonly/>
                </div>

                <div class="input-box">
                    <label>Amount</label>
                    <input type="text" name="amount" value="₹2000" readonly/>
                </div>

                <div class="input-box payment-mode">
                    <label>Payment Mode</label>
                    <div>
                        <input type="radio" id="upi" name="payment-mode" value="UPI" disabled>
                        <label for="upi">UPI</label>
                        <span class="unavailable-message">(Currently Unavailable)</span>
                    </div>
                    
                    <div>
                        <input type="radio" id="card" name="payment-mode" value="CARD" required>
                        <label for="card">CARD</label>
                    </div>
                </div>

                <div>
                    <button class="btn-primary" id="submit-btn" name="submit" value="Submit" disabled>Proceed To Payment Page</button>
                </div>
            </form>
        </section>
        <script>
            var validateName = function(element) {
                var namePattern = /^[a-zA-Z ]+$/;
                var value = element.value;
                if (!namePattern.test(value)) {
                    showErrorMessage(element, 'Name should be in proper format');
                    disableSubmitButton();
                } else {
                    hideErrorMessage(element);
                    enableSubmitButton();
                }
            };
            
            var validateEmail = function(element) {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var value = element.value;
                if (!emailPattern.test(value)) {
                    showErrorMessage(element, 'Invalid email address');
                    disableSubmitButton();
                } else {
                    hideErrorMessage(element);
                    enableSubmitButton();
                }
            };
            
            var validatePhoneNumber = function(element) {
                var phoneNumberPattern = /^\d{10}$/;
                var value = element.value;
                if (!phoneNumberPattern.test(value)) {
                    showErrorMessage(element, 'Invalid phone number');
                    disableSubmitButton();
                } else {
                    hideErrorMessage(element);
                    enableSubmitButton();
                }
            };
            
            var showErrorMessage = function(element, message) {
                var errorMessageElement = element.parentElement.querySelector('.error-message');
                if (!errorMessageElement) {
                    errorMessageElement = document.createElement('span');
                    errorMessageElement.classList.add('error-message');
                    element.parentElement.appendChild(errorMessageElement);
                }
                errorMessageElement.textContent = message;
            };
            
            var hideErrorMessage = function(element) {
                var errorMessageElement = element.parentElement.querySelector('.error-message');
                if (errorMessageElement) {
                    errorMessageElement.remove();
                }
            };
            
            var enableSubmitButton = function() {
                var submitButton = document.getElementById('submit-btn');
                submitButton.removeAttribute('disabled');
            };
            
            var disableSubmitButton = function() {
                var submitButton = document.getElementById('submit-btn');
                submitButton.setAttribute('disabled', true);
            };
            
            window.addEventListener('DOMContentLoaded', function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var user = JSON.parse(xhr.responseText);
                        document.querySelector('input[name="name3"]').value = user.name;
                        document.querySelector('input[name="email3"]').value = user.email;
                    }
                };
                xhr.open('GET', 'prepopulate_email.php', true); // Replace 'fetch_user_details.php' with your server-side script to retrieve user details
                xhr.send();
            });

            var dateInput = document.getElementById('date');
            dateInput.addEventListener('change', function() {
                var selectedDate = new Date(this.value);
                if (isDateAvailable(selectedDate)) {
                    enableSubmitButton();
                } else {
                    disableSubmitButton();
                }
            });

            var isDateAvailable = function(date) {
                // Implement your logic to check if the date is available or not
                // Return true if the date is available, otherwise return false
                return true;
            };
        </script>
    </body>
</html>
