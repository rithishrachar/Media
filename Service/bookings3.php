<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE-Edge"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <title>Responsive bookings form in html</title>
        <link rel="stylesheet" href="bookings3.css"/>
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
        <section class="container">
            <header>ARTICLE</header>
            <form action="artical.php" enctype="multipart/form-data" method="POST" class="form" onsubmit="return checkFileName(event)">
                <div class="input-box">
                    <label>Full Name</label><span id="message1">*</span>
                    <input type="text" placeholder="Enter full name" name="name3" pattern="[A-Za-z ]+" onblur="validateName(this)" required/>
                </div>
                <div class="input-box">
                    <label>Email Address</label><span id="message2">*</span>
                    <input type="text" placeholder="Enter Email Address" name="email3" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" onblur="validateEmail(this)" readonly/>
                </div>
                <div class="input-box">
                    <label>Phone Number</label><span id="message3">*</span>
                    <input type="text" placeholder="Enter Phone Number" name="number" pattern="[0-9]{10}" title="Phone number should contain 10 digits" onblur="validatePhoneNumber(this)" required/>
                </div>
                <div class="input-box">
                    <label>Title</label>
                    <input type="text" placeholder="Enter title of article" name="title" required/>
                </div>
                <div class="input-box">
                    <label>Article</label>
                    <textarea placeholder="Enter the Article" name="artical" cols="75" rows="6"></textarea>
                </div>
                <div class="input-box">
                    <label>Upload File</label>
                    <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png, image/pdf, image/document, image/docx">
                </div>
                <button type="submit">Submit</button>
            </form>
        </section>
        <script>
            // ... existing code ...

            function checkFileName(event) {
                event.preventDefault(); // Prevent the default form submission

                var fileInput = document.getElementById('image');
                var fileName = fileInput.value.split('\\').pop(); // Extract the file name from the file input

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.exists) {
                                alert('File with the same name already exists. Please choose a different file.');
                                fileInput.value = ''; // Clear the file input value
                            } else {
                                // If the file name is unique, proceed with the form submission
                                event.target.submit();
                            }
                        } else {
                            alert('Error checking file name. Please try again.');
                        }
                    }
                };

                xhr.open('POST', 'check_filename.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('filename=' + encodeURIComponent(fileName));
            }
        </script>
        <script>
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
        </script>
    </body>
</html>
