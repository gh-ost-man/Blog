<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body>
<?php  if(!isset($_SESSION)) session_start(); ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mr-auto">
    <a class="navbar-brand" href="#">BLOG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      
      
      <ul class="navbar-nav mr-auto">
      <?php if(isset($_SESSION['Auth'])) { ?>
        <li class="nav-item active">
          <a class="nav-link" href="#">Records <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">My Records <span class="sr-only">(current)</span></a>
        </li>

        <?php if($_SESSION['Role'] == 'Адміністратор') { ?> 
        <li class="nav-item active">
          <a class="nav-link" href="#">Admin panel <span class="sr-only">(current)</span></a>
        </li>
        <?php } ?>
      <?php } ?>
      </ul>
     

      <div>

      <?php if(isset($_SESSION['Auth'])) { ?>
        <img src="<?= $_SESSION['Avatar'] ?>" class="rounded-circle float-left" style=" max-width: 420x; max-height: 40px;" alt="...">
        <div class="float-left">
          <p class="m-1 text-light "><?= $_SESSION['Nick'] ?></p>
          <p class="m-1 text-light"><?= $_SESSION['Email'] ?></p>
        </div>
        <a class="btn btn-outline-info float-left" href="/user/logOut">Log out</a>
      <?php } else { ?>

        <a class="btn btn-outline-success" href="/user/login">Sign In</a>
        <a class="btn btn-outline-info" href="/user/register">Sign Up</a>
        <a class="btn btn-outline-info" href="/user/logOut">Log out</a>
      <?php } ?>

      </div>
    </div>
  </nav>

<?php 
  if(!isset($_SESSION)) session_start();
  var_dump($_SESSION);
  echo '<br>';
  echo '<br>';
  echo '<br>';
  echo '<br>';
  echo '<br>';

  //if (isset($_SESSION['error'])){
?>
<!-- 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>ERROR!</strong> <?= $_SESSION['error'] ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div> -->

<?php //} ?>