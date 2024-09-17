  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <title>notes</title>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/dashboard.css">
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
  <body>
  <?php
            include_once 'includes/login.php';
            include_once 'includes/db_connectors.php';

            // Check if the user is logged in
            if (!isset($_SESSION['user_id'])) {
                echo "User is not logged in";
                exit(); 
            } 

            try {
                $conn = connectDB();
                $user_id = $_SESSION['user_id']; 
                $stmt = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if user data exists
                if (!$user) {
                    echo "User data not found.";
                    exit();
                }

                // Check if photo data exists
                if (!isset($user['photo'])) {
                    echo "No photo data found for the user.";
                    exit();
                }

                // Convert photo data to base64 encoding
                $user_photo_base64 = base64_encode($user['photo']);

                // Check if base64 encoding was successful
                if (!$user_photo_base64) {
                    echo "Error encoding photo data to base64.";
                    exit();
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

                ?>

  
  <div class="container">
            <div class="sidebar">
            <div class="logo">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="data:image/jpeg;base64,<?php echo $user_photo_base64; ?>" alt="User Photo"style="width:50px;width:50px;  border-radius: 50%;object-fit: contain;">
            <div class="logo_name" style="text-align:center;color:white;margin-right:45px; transform: scale(0.8); "><?php echo $user['name']; ?></div>
            <div class="name">

            <div class="logo-details">
            <i class='bx bx-menu' id="btn" ></i>
            </div>
            </div>
      </div>
      <ul class="nav-list">
            <li id="addNoteBtn">
            <a href="#">
            <i class='fas fa-edit'></i></i>
            <span class="links_name">Add Notes</span>
            </a>
            </li>
            <li id ="allNotes">
            <a href="#">
            <i class='fas fa-book'></i>
            <span class="links_name">All Notes</span>
            </a>
            </li>
            <li id="favoriteBtn">
            <a href="#" onclick="toggleFavoriteSidebar()">
            <i class='far fa-star'></i>
            <span class="links_name">Favorite</span>
            </a>
            </li>
            <li id="archive">
            <a href="#">
            <i class="fa fa-archive"></i>
            <span class="links_name">Archives</span>
            </a>
            </li>
            </ul>
    </div>
<section class="home-section">
    <div class="left">
        <div class="header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
            <div class="search">
            <input type="text" id="searchInput" placeholder="Search.." oninput="searchMessages()">
            </div>
            <a href="logout.php"><i class='bx bx-log-out' id="log_out" ></i></a>
            </div>
            <div class="noteApp">
            <h1 id="pageTitle"style="color:white;font-size: 35px;text-shadow:5px 5px 10px black;
  font-weight: 600;">Online Notes</h1>
            </div>

     
        <div class="main-content">
        <div class="notes-grid " id="notesGrid">

        <?php

include_once 'includes/db_connectors.php'; // Update this path as needed

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
echo "User is not logged in";
exit(); 
} 

// Fetch notes for the logged-in user
try {
$conn = connectDB();
$user_id = $_SESSION['user_id']; 
$stmt = $conn->prepare("SELECT * FROM notes WHERE u_id = ? AND archive = 0");
$stmt->execute([$user_id]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}

?>

        <?php 
        // Initialize a counter for note numbers
        $noteNumber = 1;
        foreach ($notes as $note): 

            $starClass = $note['favorite'] ? 'fas' : 'far';
        ?>
        <div class="note">
        <div class="note-header">
        <button class="three-dots" onclick="toggleMenu(this)">...</button> 
        <div class="dropdown-menu hidden">
        <ul>
        <li class="eye-icon" onclick="toggleAndView(<?php echo $note['n_id']; ?>)"><i class="fas fa-eye"></i></li>

        <li class="pen-icon" onclick ="editNote(<?php echo $note['n_id']; ?>)"><i class="fas fa-edit"></i></li>

        <li onclick="delete_note(<?php echo $note['n_id']; ?>)"><i class="fas fa-trash-alt"></i></li>
        <li data-note-id="<?php echo $note['n_id']; ?>" onclick="toggleFavorite(event)">
    <i id="favorite-icon" class="<?php echo $starClass; ?> fa-star <?php echo $starClass === 'fas' ? 'starrs' : ''; ?>"></i>
</li>

    <li id="achive" onclick="archive_note(<?php echo $note['n_id']; ?>)"><i class="fa fa-archive"></i></li>
    


        </ul>
        </div>
        </div>

        <div class="note-content">
        <h3 style="text-align: center;">Note <?php echo $noteNumber++; ?></h3> <!-- Display note number -->
        <p style="text-align: center;
  margin: 0 auto;font-size:15px;text-transform: capitalize;"><br><?php echo $note['title']; ?></p>
        </div>
        <h5 style=" text-align: center;
  background-color: #f598c3;width:70%;
  margin: 0 auto;font-size:12px;border-radius:20px;margin-top:20px;color:black;">Created at:<?php echo $note['created_at'];?></h5> 
        </div>
        <?php endforeach; ?>
        </div>

            <div class="notes-grid hidden" id ="favorit">
            <?php

            include_once 'includes/db_connectors.php'; // Update this path as needed

            // Check if the user is logged in
            if (!isset($_SESSION['user_id'])) {
            echo "User is not logged in";
            exit(); 
            } 

            // Fetch notes for the logged-in user
            try {
            $conn = connectDB();
            $user_id = $_SESSION['user_id']; 
            $stmt = $conn->prepare("SELECT * FROM notes WHERE u_id = ? AND favorite = 1 AND archive = 0");
            $stmt->execute([$user_id]);
            $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

            

?>
<?php 
        // Initialize a counter for note numbers
        $favNumber = 1;
        foreach ($notes as $note): 
           
            $starClass = $note['favorite'] ? 'fas' : 'far';
        ?>
        <div class="note">
        <div class="note-header">
        <li data-note-id="<?php echo $note['n_id']; ?>" onclick="toggleFavorite(event)">
    <i id="favorite-icon" class="<?php echo $starClass; ?> fa-star <?php echo $starClass === 'fas' ? 'starrs' : ''; ?>"></i>
</li>
        <button class="three-dots" onclick="toggleMenu(this)">...</button> 
       
        <div class="dropdown-menu hidden">
        <ul>
        <li class="eye-icon" onclick="toggleAndView(<?php echo $note['n_id']; ?>)"><i class="fas fa-eye"></i></li>

        <li class="pen-icon" onclick ="editNote(<?php echo $note['n_id']; ?>)"><i class="fas fa-edit"></i></li>
        <li onclick="delete_note(<?php echo $note['n_id']; ?>)"><i class="fas fa-trash-alt"></i></li>
        


    <li onclick="archive_note(<?php echo $note['n_id']; ?>)"><i class="fa fa-archive"></i></li>
    


        </ul>
        </div>
        </div>

            <div class="note-content">
            <h3 style="text-align: center;">Note <?php echo $favNumber++; ?></h3> <!-- Display note number -->
            <p style="text-align: center;
            margin: 0 auto;font-size:15px;text-transform: capitalize;"><br><?php echo $note['title']; ?></p>
            </div>
            <h5 style=" text-align: center;
            background-color: #f598c3;width:70%;
            margin: 0 auto;font-size:12px;border-radius:20px;margin-top:20px;color:black;">Created at:<?php echo $note['created_at'];?></h5> 
            </div>
            <?php endforeach; ?>
            </div>


            <div class="notes-grid hidden" id ="archiv">

<?php

include_once 'includes/db_connectors.php'; // Update this path as needed

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
echo "User is not logged in";
exit(); 
} 

// Fetch notes for the logged-in user
try {
$conn = connectDB();
$user_id = $_SESSION['user_id']; 
$stmt = $conn->prepare("SELECT * FROM notes WHERE u_id = ? AND archive = 1");
$stmt->execute([$user_id]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}



?>
<?php 
// Initialize a counter for note numbers
$favNumber = 1;
foreach ($notes as $note): 

?>
<div class="note">
<div class="note-header">
<button class="three-dots" onclick="toggleMenu(this)">...</button> 
<div class="dropdown-menu hidden">
<ul>
<li class="eye-icon" onclick="toggleAndView(<?php echo $note['n_id']; ?>)"><i class="fas fa-eye"></i></li>

<form id = "forms" action="update_note.php" method = "post">
<input type="hidden" value ="<?php echo $note['u_id']; ?>" name = "id">
</form>
<li onclick="delete_note(<?php echo $note['n_id']; ?>)"><i class="fas fa-trash-alt"></i></li>
<li >
    <li onclick="restore_note(<?php echo $note['n_id']; ?>)"><i class='bx bx-recycle'></i></li>
    
</li>

</ul>
</div>
</div>

<div class="note-content">
<h3 style="text-align: center;">Note <?php echo $favNumber++; ?></h3> <!-- Display note number -->
<p style="text-align: center;
margin: 0 auto;font-size:15px;text-transform: capitalize;"><br><?php echo $note['title']; ?></p>
</div>
<h5 style=" text-align: center;
background-color: #f598c3;width:70%;
margin: 0 auto;font-size:12px;border-radius:20px;margin-top:20px;color:black;">Created at:<?php echo $note['created_at'];?></h5> 
</div>
<?php endforeach; ?>

            </div>

        </div>
    <div class="overlay1" id="overlay1">
        <div id="addNoteForm" class="modal">
        <span class="close">&times;</span>
        <h2 style="color:white;font-size:20px; font-weight: 900;text-shadow: 5px 5px 10px black;">Take Note</h2>
        <form action="includes/insert_note.php" method="POST">
        <input type="text" placeholder="Title here..." id="noteTitle" name="noteTitle" required><br><br>
        <textarea id="noteContent" placeholder="Add Note..." name="noteContent" required></textarea><br><br>
        <button type="submit" id="add"style="color:white;">Add Note</button>
        </form>
        </div>
    </div>

    <div class="overlay2" id="overlay2">
        <div id="updateForm" class="modal">
       
        </div>
    </div>
        
    </div>
    <div class="overlay" id="overlay">
        <div class="view"id="view" onclick="hideOverlay()"> 
        </div>
        </div>
</section>

</div>
<script src="js/script.js"></script>
  </body>
  </html>