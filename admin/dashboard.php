<?php
  include 'config.php';
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu  | CodingLab </title>
    <link rel="stylesheet" href="dashboardn.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://kit.fontawesome.com/f1a5209d4b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
   </head>
<body>
  
  <div class="sidebar">
    <div class="logo-details">
      
        <div class="logo_name">News Karkala</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <!-- <li>
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li> -->
      <!-- <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li> -->
      <li>
       <a href="dashboard.php">
         <i class='bx bx-home' ></i> 
         <span class="links_name">Home</span>
       </a>
       <span class="tooltip">Home</span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-user' ></i>
         <span class="links_name">Employees</span>
         <ul class="dropdown">
          <li><a href="addemp.php">Add Employee</a></li>
          <li><a href="delete.php">Delete Employee</a></li>
          <li><a href="viewemp.php">Update Employee</a></li>
          <li><a href="viewemp.php">View Employee</a></li>
      </ul>
       </a>
       <span class="tooltip">Employees</span>
     </li>
     <li>
      <a href="../website/admin_page.php">
        <i class='bx bx-money' ></i>
        <span class="links_name">Profile</span>
      </a>
      <span class="tooltip">Profile</span>
    </li>

     <li>
       <a href="e2.php">
         <i class='bx bx-message' ></i>
         <span class="links_name">Leave Applications</span>
       </a>
       <span class="tooltip">Leave Applications</span>
     </li>
    
     <li>
      <a href="youtubestatus.php">
      <i class="fa-brands fa-youtube"></i>
        <span class="links_name">Youtube</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li> -->
          <!-- <li><a href="../Service/articleview.php">Article</a></li> -->
          
      <!-- </ul> -->
      </a>
      <span class="tooltip">Youtube</span>
    </li>

    <li>
      <a href="../Service/articalview.php">
        <i class='bx bx-news' ></i>
        <span class="links_name">Article</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li>
          <li><a href="../Service/articleview.php">Article</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Article</span>
    </li>

    <li>
      <a href="../Service/viewad.php">
        <i class='bx bx-spreadsheet' ></i>
        <span class="links_name">Advertisement</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li>
          <li><a href="../Service/articleview.php">Article</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Advertisement</span>
    </li>
    <li>
      <a href="salaryemp.php">
        <i class='bx bx-money' ></i>
        <span class="links_name">Employee Salary</span>
      </a>
      <span class="tooltip">Employee Salary</span>
    </li>
    <!-- <li>
       <a href="#">
         <i class='bx bx-task' ></i>
         <span class="links_name">Tasks</span>
         <ul class="dropdown">
          <li><a href="#">Assign Task</a></li>
          <li><a href="#">Task Status</a></li>
      </ul>
       </a>
       <span class="tooltip">Tasks</span>
     </li> -->
     <li>
      <a href="../feed/viewfeedback.php">
        <i class='bx bx-user-pin' ></i>
        <span class="links_name">Feedback</span>
      </a>
      <span class="tooltip">Feedback</span>
    </li>
     <li>
      <a href="../logout.php">
        <i class='bx bx-log-out' ></i>
        <span class="links_name">Log-Out</span>
      </a>
      <span class="tooltip">Log-Out</span>
    </li>
   
    
    </ul>
    
   
  </div>
  <section class="home-section">
  
  </section>
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });
  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });
  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>
  
</body>
</html>