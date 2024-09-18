<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->

<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Notes</title>
<link rel="stylesheet" href="css/my.css" >
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body >
        <nav>
        <div class="menu">
        <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/128/1055/1055666.png" style="height: 50px; width: 50px; border-radius: 50%; ">&nbsp;&nbsp;</a>
        <h2 class="onlinenotes">NOTE APP</h2>
</div>
      <ul>
          <li><a href="" class="nav-link">Home</a></li>
          <li><a href="about-us.php" class="nav-link">About</a></li>
          <div class="butt">
          <li><a href="register.php" class="nav-link">REGISTER</a></li>
          <li><a href="signin.php" class="nav-link">SIGN IN</a></li>
      </ul>

</nav>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(event) {
      // Remove active class from all links
      navLinks.forEach(function(link) {
        link.classList.remove('active');
      });

      // Add active class to the clicked link
      navLink.classList.add('active');
    });

    // Check if the current URL matches the href attribute of the link
    if (window.location.href === navLink.href) {
      navLink.classList.add('active');
    }
  });
});


</script>
</div>
</div>
</body>
</html>