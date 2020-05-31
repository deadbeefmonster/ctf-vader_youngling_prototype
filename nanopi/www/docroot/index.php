<?php
include "config.php";

//$page = $_SESSION['loggedin'] ? 'notes' : 'login';
$page = 'notes';
if (isset($_REQUEST['page'])) {
   $page = $_REQUEST['page'];
}
?>


<!-- HEADER -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DEVELOPMENT ONLY - DARTH YOUNGLING PROTOTYPE PROJECT</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="">DEVELOPMENT ONLY - DARTH YOUNGLING PROTOTYPE PROJECT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
	    <a href="/index.php?page=notes" class="nav-link">View Notes</a>
          </li>
          <li class="nav-item">
	    <a href="/index.php?page=noteadd" class="nav-link">Add Note</a>
          </li>
          <li class="nav-item">
	    <a href="/index.php?page=login" class="nav-link">Login</a>
          </li>
          <li class="nav-item">
	    <a href="/index.php?page=register" class="nav-link">Register</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
<!-- END HEADER -->




<!-- CONTENT -->
<?php
include($page . '.php');
?>
<!-- END CONTENT -->







<!-- FOOTER -->
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


<!-- END FOOTER -->

<!-- YmFja3VwLzMzYTU3MDA3NGMyODdlMTM2YWU0ZDVjYTk2OWZhMzVhLzcvYWxkZXJhbl9rYWJvb21fbG9sLWZsYWctYmIyNzlmNTdkNDU0ZDczY2IucGhw -->
