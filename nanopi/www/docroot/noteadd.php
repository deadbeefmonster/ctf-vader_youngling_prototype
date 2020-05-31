<?php

require_once "config.php";

if (! $_SESSION['loggedin']) {
    echo '<h1 class="mt-5">ACCESS RESTRICTED</h1>';
}
else {
    echo '<h1 class="mt-5">Developer Notes</h1><p class="lead">These are notes between us clones, but access is obviously restricted. Only approved clones are allowed access.</p>';

// Save it
if ($_REQUEST['subject'] && $_REQUEST['note']){
    $is_hidden = $_REQUEST['hidden'] ? 1 : 0;
    $insert_sql = "insert into notes (login_id, subject, note, is_hidden, added_ts, updated_ts) values (?,\"".$_REQUEST['subject']."\",?,?,now(),now())";
    $insert_sth = $pdo->prepare($insert_sql);
    $insert_sth->execute([$_SESSION['loggedin_data']['id'],
                         $_REQUEST['note'], $is_hidden]);
    $insert_id = $pdo->lastInsertId();
    if ($insert_id) {
        header("Location: /index.php?page=notes#".$insert_id);
        exit;
    }
    else {
        echo '<span style="color:red;">Could not save note!</span>';
    }
}
// Display form
else { ?>
 
<form action="/index.php?page=noteadd" method="post">
    <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" />
    </div>
    <div class="form-group">
    <label for="note">Note</label>
    <textarea class="form-control" id="note" name="note"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Note</button>
</form>

<?php }
}
// Why did the empire choose PHP?! 
?>

