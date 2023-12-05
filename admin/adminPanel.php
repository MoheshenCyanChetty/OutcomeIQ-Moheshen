<?php
  require_once('..\\config\\database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>

  <!-- top nav section -->
  <div class="nav">
    <img src="../images/LogoWhiteTextOutcomeIQ.svg" alt="OutcomeIQ White Font logo">

    <div class="searchContainer">
      <form action="">

        <button type="submit">
          <span class="material-symbols-outlined">
            search
          </span>
        </button>
        <input type="text" name="search" id="search" placeholder="Search User...">
      </form>
    </div>

    <div class="lecturerName">Dingani Gumbi</div>

    <div class="lecturerInitials">DG</div>

  </div>
  <!-- heading -->
  <div class="btnHeading">Manage Users</div>
  <!-- container for the left side buttons and table -->
  <div class="container">

    <div class="menu_container">
      <button class="menuButtons manageUsers">Manage Users</button>
      <button class="menuButtons manageStudents">Manage Students</button>
      <button class="menuButtons addUser">Add User</button>
      <button class="menuButtons addStudent">Add Student</button>
      <button class="menuButtons manageFaqs">Manage FAQs</button>
      <button class="menuButtons addFaqs">Add FAQs</button>
    </div>

    <div class="right_container">

      <div class="manageUsersContainer hidden ">
        <div class="heading firstHeading">Lecturer Status</div>
        <div class="heading">Lecturer Name</div>
        <div class="heading">Edit</div>
        <div class="heading lastHeading">Delete</div>
        <div class="content">Admin</div>
        <div class="content">Takunda Dzingirayi</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Admin</div>
        <div class="content">Chief Keith</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Not admin</div>
        <div class="content">Shimitsu Sharimba</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Not Admin</div>
        <div class="content">Newman Blessing</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Admin</div>
        <div class="content">Kevin Simba</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Admin</div>
        <div class="content">Faruk Islamon</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>

      </div>

      <div class="manageStudentsContainer hidden">
        <div class="heading firstHeading">Student Number</div>
        <div class="heading"> Name</div>
        <div class="heading">Edit</div>
        <div class="heading lastHeading">Delete</div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Takunda Dzingirayi</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Chief Keith</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Shimitsu Sharimba</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Newman Blessing</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Kevin Simba</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Takunda Dzingirayi</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Takunda Dzingirayi</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content"><span class="stundentNo">402105203</span></div>
        <div class="content">Takunda Dzingirayi</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
      </div>

      <div class="addUserContainer hidden">
        <form action="">
          <input type="text" name="errorMessages" id="errorMessages" placeholder="Error Messages go here">
          <input type="text" name="firstName" id="firstName" placeholder="First Name">
          <input type="text" name="lastName" id="lastName" placeholder="Last Name">
          <input type="email" name="email" id="email" placeholder="Valid Email Address">
          <button type="submit">Send Link to email <span class="material-symbols-outlined">send</span></button>
        </form>
      </div>

      <div class="addStudentContainer hidden">
        <form action="">
          <input type="text" name="errorMessages" id="errorMessages" placeholder="Error Messages go here">
          <input type="text" name="firstName" id="firstName" placeholder="First Name">
          <input type="text" name="lastName" id="lastName" placeholder="Last Name">
          <input type="email" name="email" id="email" placeholder="Valid Email Address">

          <div class="buttons">

            <div class="courseDropdown">
              <button class="course" type="submit">Couse <span class="material-symbols-outlined">arrow_drop_down</span></button>
              <div class="dropdown">
                <button>Bachelor of Sciences in Information Technology</button>
                <button>Diploma in Information Technology</button>
                <button>Higher Certificate in Information Technology</button>
              </div>

            </div>
            <div class="electiveDropdown">
              <button class="elective" type="submit">Elective <span class="material-symbols-outlined">arrow_drop_down</span></button>
              <div class="dropdown">
                <button>Programming 742(E)(1)</button>
                <button>Autonomous Systems & Robotics 700(E)(2)</button>
                <button>IT Strategic Management 732(E)(3)</button>
                <button>Networks 732(E)(4)</button>
                <button>Programming 632(E)(5)</button>
                <button>Networks 632(E)(6)</button>
                <button>Business Analysis 632(E)(7)</button>
              </div>
            </div>
          </div>
          <button class="btnAddStudent">Add New Student +</button>
          <button class="btnImportStudents">Import Many Students +</button>
        </form>
      </div>

      <div class="manageFaqsContainer hidden">
        <div class="heading firstHeading">Question</div>
        <div class="heading">Edit</div>
        <div class="heading lastHeading">Delete</div>
        <div class="content">What is OutcomeIQ for?</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">Who is OutComeIQ meant for</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>
        <div class="content">How do I use OutcomeIQ</div>
        <div class="content"><button class="edit">Edit</button></div>
        <div class="content"><button class="delete">Delete</button></div>



      </div>

      <div class="addFaqsContainer hidden">
        <form action="">
          <input type="text" name="errorMessages" id="errorMessages" placeholder="Error Messages go here">

          <input type="text" name="question" id="question" placeholder="Question">
          <textarea name="myTextarea" id="myTextarea" placeholder="Answer">
            
          </textarea>
          <button type="submit">Submit Question+</button>
        </form>

      </div>
    </div>



  </div>
  <script>
    // Containers
  let manageUsersContainer = document.querySelector(".manageUsersContainer");
  let manageStudentsContainer = document.querySelector(".manageStudentsContainer");
  let addUserContainer = document.querySelector(".addUserContainer");
  let addStudentContainer = document.querySelector(".addStudentContainer");
  let manageFaqsContainer = document.querySelector(".manageFaqsContainer");
  let addFaqsContainer = document.querySelector(".addFaqsContainer");
  let wholeContainer = document.querySelector(".right_container");
  let btnHeading = document.querySelector(".btnHeading");

  // Buttons
  let menuBtn1 = document.querySelector(".manageUsers");
  let menuBtn2 = document.querySelector(".manageStudents");
  let menuBtn3 = document.querySelector(".addUser");
  let menuBtn4 = document.querySelector(".addStudent");
  let menuBtn5 = document.querySelector(".manageFaqs");
  let menuBtn6 = document.querySelector(".addFaqs");

  // Event listeners
  menuBtn1.addEventListener("click", function() {
    showContainer(manageUsersContainer);
    btnHeading.textContent = "Manage Users";
  });

  menuBtn2.addEventListener("click", function() {
    showContainer(manageStudentsContainer);
    btnHeading.textContent = "Manage Student";
  });

  menuBtn3.addEventListener("click", function() {
    showContainer(addUserContainer);
    btnHeading.textContent = "Add New User";
  });

  menuBtn4.addEventListener("click", function() {
    showContainer(addStudentContainer);
    btnHeading.textContent = "Add New Student";
  });

  menuBtn5.addEventListener("click", function() {
    showContainer(manageFaqsContainer);
    btnHeading.textContent = "Manage Frequently Asked Questions";
  });

  menuBtn6.addEventListener("click", function() {
    showContainer(addFaqsContainer);
    btnHeading.textContent = "Add Frequently Asked Questions";
  });

  
  function showContainer(containerToShow) {
   
    Array.from(wholeContainer.children).forEach(function (container) {
      container.classList.add('hidden'); 
    });

   
    containerToShow.classList.remove('hidden');
  }
  </script>
</body>
</html>