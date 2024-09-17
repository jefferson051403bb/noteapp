<?php include_once 'templates/myheader.php'; ?>

<form action="includes/login.php" method="POST" id="loginForm">
    <h1>Online Notes</h1>
    <h5>Login to continue.</h5>
    <label for="email">Email:</label>
    <input placeholder="Your Email" autofocus="autofocus" autocomplete="email" type="email" value="" name="email" id="email">
    <br>
    <label for="password">Password:</label>
    <input type="password" placeholder="Your Password (at least 8 characters)" id="password" name="password" required>
    <button type="submit" id="signin">Login</button>
    <div class="s"><label>Do want to create an Account??</label><a href="register.php">Sign In</a></div>
</form>

<script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

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
