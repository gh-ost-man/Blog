<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/85e3aaf13e.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  
</head>
<body>
  <?php  
    if(!isset($_SESSION)) session_start(); 
    $user;
    if(isset($_SESSION['user']))  $user = json_decode($_SESSION['user'],true);
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mr-auto">
    <a class="navbar-brand" href="/blog">BLOG</a>
      
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <?php if(isset($_SESSION['Auth'])) { ?>
        
        <li class="nav-item active">
          <a class="nav-link" href="#">Records <span class="sr-only">(current)</span></a>
        </li>

      <?php if($user['role']  == 'Autor') { ?>
        <li class="nav-item active">
          <a class="nav-link" href="#">My Records <span class="sr-only">(current)</span></a>
        </li>
      <?php } ?>

        <?php if($user['role'] == 'Administrator') { ?> 
        <li class="nav-item active">
          <a class="nav-link" href="#">Admin panel <span class="sr-only">(current)</span></a>
        </li>
        <?php } ?>

      <?php } ?>
      </ul>
      <div>
        <?php if(isset($_SESSION['Auth']) || isset($_GET['id'])) { ?>
        <div class="btn-group">
          <a class="float-left" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?= (isset($_GET['id']))? "/" . $user['url_avatar']:$user['url_avatar'] ?>" class="rounded-circle " style="max-width: 50x; max-height: 50px;" alt="...">
          </a>
          <div class="float-left text-center">
            <p class=" text-light text-center ml-1 mt-2" ><?= $user['nick'] ?></p>
            <!-- <p class="m-1 text-light"><?= $user['email'] ?></p> -->
          </div>
          <div class="dropdown-menu dropdown-menu-right bg-dark p-2 float-right" style="width: 300px;" aria-labelledby="dropdownMenu2">
            <div class="card bg-dark">
              <img src="<?= (isset($_GET['id']))? "/" . $user['url_avatar']:$user['url_avatar'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center text-info"><?= $user['nick'] ?></h4>
                <p class="card-text text-center text-warning"><?= $user['email']?></p>
              </div>
            </div>
            <a href="/user/edit?id=<?= $_SESSION['Auth'] ?>" class="w-100 mt-1 btn btn-outline-warning">Edit</a>
            <a href="/user/logOut" class="w-100 mt-1 btn btn-outline-info" >Sign out</a>
          </div>
        </div>
        <?php } else { ?>
        <a class="btn btn-outline-success" href="/user/login">Sign In</a>
        <a class="btn btn-outline-info" href="/user/register">Sign Up</a>
        <?php } ?>
      </div>
    </div>
  </nav>

<?php 
  if(!isset($_SESSION)) session_start();
  //var_dump(json_decode($_SESSION['user']));
  

 // if (isset($_SESSION['error'])){
?>

<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>ERROR!</strong> <?= $_SESSION['error'] ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div> -->

<?php  //} unset($_SESSION); ?>