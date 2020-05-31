<?php

require_once "config.php";

if (! $_SESSION['loggedin']) {
    echo "<h1  class=\"mt-5\">ACCESS RESTRICTED</h1>";
}
else {
    echo '<h1 class="mt-5">Developer Notes</h1><p class="lead">These are notes between us clones, but access is obviously restricted. Only approved clones are allowed access.</p>';
    $sql = 'select * from notes where is_hidden is false order by id desc';
    if (isset($_REQUEST['show_hidden_developer_only'])) {
        $sql = 'select * from notes where is_hidden is true order by id desc';
    }
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
echo '<!-- ID:'.$row['id'].' is_hidden:'.$row['is_hidden'].' -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">'.$row['subject'].'</h5>
    <p class="card-text">'.$row['note'].'</p>
  </div>
</div>';
    }
}
?>
