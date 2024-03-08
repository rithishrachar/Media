<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 20px;
            border-right: 1px solid #ddd; /* Add vertical line */
        }
        th:last-child, td:last-child {
            border-right: none; /* Remove vertical line for last column */
        }
        th {
            background-color: darkorange;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        td:first-child {
            width: 5%;
        }
        td:nth-child(5) {
            width: 15%;
        }
        td:last-child {
            width: 30%;
        }
        /* CSS for the navigation bar */
        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: dodgerblue;
            color: white;
        }

        /* CSS for the buttons */
        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }

        .buttons button:hover {
            background-color: dodgerblue;
        }

        .active-button {
            background-color: dodgerblue;
            color: white;
        }
    </style>
    <div class="navbar">
        <a class="active" href="../admin/dashboard.php">HOME</a>
        <a href="../logout.php">LOGOUT</a>
        <!-- <a href="#">Contact</a> -->
    </div>
</head>
<body>
    <h2>FEEDBACK DETAILS</h2>

    <div class="buttons">
        <button class="filter-button active-button" data-filter="all">All</button>
        <button class="filter-button" data-filter="Excellent">Excellent</button>
        <button class="filter-button" data-filter="Good">Good</button>
        <button class="filter-button" data-filter="Neutral">Neutral</button>
        <button class="filter-button" data-filter="Poor">Poor</button>
    </div>

    <table id="feedback-table">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>SATISFACTION</th>
            <th>COMMENTS</th>
            <th>DELETE FEEDBACK</th>
        </tr>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nk";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Check if delete button is clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Delete the corresponding row from the database
    $deleteSql = "DELETE FROM poll WHERE id = $id";
    if ($conn->query($deleteSql) === TRUE) {
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Task Deleted successfully. Redirecting...</div>';
        header("refresh:3; url=http:viewfeedback.php"); // Redirect to success page after 5 seconds
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
        // Fetch data from poll table
        $sql = "SELECT * FROM poll";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='feedback-row' data-category='".$row['suggestions']."'>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['suggestions']."</td>";
                echo "<td>".$row['feedback']."</td>";
                echo "<td><a href='?delete=".$row['id']."'>Delete</a></td>"; // Add delete button
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No feedback found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <script>
        const buttons = document.getElementsByClassName("filter-button");
        const rows = document.getElementsByClassName("feedback-row");

        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function() {
                const category = this.getAttribute("data-filter");

                for (let j = 0; j < buttons.length; j++) {
                    buttons[j].classList.remove("active-button");
                }

                this.classList.add("active-button");

                if (category === "all") {
                    for (let j = 0; j < rows.length; j++) {
                        rows[j].style.display = "table-row";
                    }
                } else {
                    for (let j = 0; j < rows.length; j++) {
                        const rowCategory = rows[j].getAttribute("data-category");
                        if (rowCategory === category) {
                            rows[j].style.display = "table-row";
                        } else {
                            rows[j].style.display = "none";
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
