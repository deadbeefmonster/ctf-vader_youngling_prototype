<?php

include "config.php";

$error_message = '';

if ($_POST['username'] && $_POST['password']) {
    // Check that the username doesn't already exist
    $select_sql = 'select * from login where username = ?';
    $select_sth = $pdo->prepare($select_sql);
    $select_sth->execute([$_POST['username']]);
    $rows = $select_sth->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        $error_message = 'You are already registered. Search your data cards or contact your commanding officer.';
    }
    else {
        // Insert login
        $insert_sql = 'insert into login (username, password, added_ts, updated_ts) values (?,?, now(),now())';
        $insert_sth = $pdo->prepare($insert_sql);
        $insert_sth->execute([$_POST['username'],md5($_POST['password'])]);
        $error_message = 'You are now registered.';
    }
}
?>
<h1 class="mt-5">Register</h1>
<p class="lead">Give your developer-only restricted and official username and password to access this system. Failure will be logged and available on your permanent record.</p>
<?php if ($error_message) { echo "<p style='color:red;'>$error_message</p>";} ?>
<form action="/index.php?page=register" method="post">
    <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" />
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" />
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
