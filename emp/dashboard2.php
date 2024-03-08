<?php

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu  | CodingLab </title>
    <link rel="stylesheet" href="dashboardn2.css">
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
      <li>
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <!-- <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li> -->
      <li>
       <a href="dashboard2.php">
         <i class='bx bx-home' ></i> 
         <span class="links_name">Home</span>
       </a>
       <span class="tooltip">Home</span>
     </li>
     
     <li>
      <a href="../website/employee_page.php">
        <i class='bx bx-user-pin' ></i>
        <span class="links_name">Profile</span>
      </a>
      <span class="tooltip">Profile</span>
    </li>

     
    
     <li>
      <a href="e1.php">
      <i class="fa-regular fa-calendar"></i>
        <span class="links_name">Apply For Leave</span>
        <!-- <ul class="dropdown">
          <li><a href="e1.php">Apply Leave</a></li>
          <li><a href="leavestatus.php">Leave Status</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Apply For Leave</span>
    </li>
    <li>
      <a href="leavestatus.php">
        <i class='bx bx-edit' ></i>
        <span class="links_name">Leave Status</span>
        <!-- <ul class="dropdown">
          <li><a href="e1.php">Apply Leave</a></li>
          <li><a href="leavestatus.php">Leave Status</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Leave Status</span>
    </li>
    <!-- <li>
       <a href="#">
         <i class='bx bx-task' ></i>
         <span class="links_name">Tasks</span>
         <ul class="dropdown">
          <li><a href="viewtask.php">Youtube Tasks</a></li>
          <li><a href="viewadtask.php">Advertisement Tasks</a></li>
          <li><a href="viewarttask.php">Artical Tasks</a></li>
      </ul>
       </a>
       <span class="tooltip">Tasks</span>
     </li> -->
     <li>
      <a href="viewtask.php">
      <i class="fa-brands fa-youtube"></i>
        <span class="links_name">Youtube Task</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li> -->
          <!-- <li><a href="../Service/articleview.php">Article</a></li> -->
          
      <!-- </ul> -->
      </a>
      <span class="tooltip">Youtube Task</span>
    </li>
    <li>
      <a href="viewarttask.php">
        <i class='bx bx-news' ></i>
        <span class="links_name">Article Task</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li>
          <li><a href="../Service/articleview.php">Article</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Article Task</span>
    </li>

    <li>
      <a href="viewadtask.php">
        <i class='bx bx-spreadsheet' ></i>
        <span class="links_name">Advertisement Task</span>
        <!-- <ul class="dropdown">
          <li><a href="youtubestatus.php">Youtube Service</a></li>
          <li><a href="../Service/articleview.php">Article</a></li>
          
      </ul> -->
      </a>
      <span class="tooltip">Advertisement Task</span>
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