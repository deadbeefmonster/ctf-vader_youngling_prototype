<?php

// Import the configuration from techops
require_once "config.php";

$error_message = '';

// Check if login attempt was made
if (isset($_POST['username']) && isset($_POST['password'])) {
   // Validate login
    $sql = 'select * from login where username = "' . $_POST['username'] . '" and password = ?';
    $sth = $pdo_ro->prepare($sql);
    // Ensure the password is escaped for security 
    $sth->execute([md5($_POST['password'])]);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        // Login OK - redirect
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['loggedin_data'] = $row;

        header("Location: /index.php");
        exit(1);
    }
    
   // Login NOT OK - drop down with error message
   $error_message = "Login failed";
}

// Display login form
?>

<h1 class="mt-5">Login</h1>
<p class="lead">Give your username and password to access this system. Failure will be logged and available on your permanent record.</p>
<?php if ($error_message) { echo "<p style='color:red;'>$error_message</p>";} ?>

<form action="/index.php?page=login" method="post">
    <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" />
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" />
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<!--
**REMOVE FROM PRODUCTION**TESTING ONLY**

Username: <?php echo $_POST['username']; ?>

Password: <?php echo $_POST['password']; ?>

**REMOVE FROM PRODUCTION**TESTING ONLY**
-->
