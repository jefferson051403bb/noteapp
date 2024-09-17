<?php include_once 'templates/myheader.php'; ?>

<form id="registrationForm" action="includes/insertion.php" method="POST" enctype="multipart/form-data">
    <h1>Registration Form</h1>
    <br>
    <h6>Fill out the form carefully for registration.</h6>
    <label for="name">Username:</label>
    <input type="text" placeholder="Input your Username" id="name" name="name" required>
    <label for="email">Email:</label>
    <input placeholder="Input your Email" autofocus="autofocus" autocomplete="email" type="email" value="" name="email" id="email">
    <label for="password">Password:</label>
    <input type="password" placeholder="Password (at least 8 characters)" id="password" name="password" required>
    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required> <br>
    <button type="submit" id="register">Register</button>
    <div class="s"><label>Already have an Account?</label><a href="signin.php">Sign In</a></div>
</form>

<script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        // Simple validation for name
        if (name.trim() === '') {
            alert("Please enter your username");
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Simple validation for email
        if (email.trim() === '') {
            alert("Please enter your email");
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Email format validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address");
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Simple validation for password
        if (password.trim() === '') {
            alert("Please enter your password");
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Password length validation
        if (password.length < 8) {
            alert("Password must be at least 8 characters long");
            event.preventDefault(); // Prevent form submission
            return;
        }
    });
</script>
</body>
</html>
