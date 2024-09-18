<?php include_once 'templates/myheader.php'; 
    if (isset($_GET['action']) && $_GET['action'] == 'register_success') {
        echo '<script>alert("New record created successfully");</script>';
    }


if (isset($_GET['login']) && $_GET['login'] == 'false') {
    echo '<script>alert("Login Unsuccessful");</script>';
}
?>
<br>
<br>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="img"></div>
<div class="center">
          <div class="title">The Best Notes For  You</div>
          <p>enable users to write and sketch in a floating window or on the full screen, capture and annotate <br>screen content, and save notes for later review and revision. Users can access note-taking apps <br>from the lock screen or while running other apps ,It gives you a quick and simple notepad editing <br>experience when you write notes, memo, email, message, shopping list and to do list. It makes to <br>take a note easier than any other notepad and memo apps</p>
          <div class="btns">
          <a href="about-us.php"><button>Learn More</button></a>
      </div>
      </div>
</body>
</html>