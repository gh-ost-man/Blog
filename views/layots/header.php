<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="shortcut icon" href="/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://kit.fontawesome.com/85e3aaf13e.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body>
  <?php  
    if(!isset($_SESSION)) session_start(); 
    if(isset($_SESSION['user']))  $user = json_decode($_SESSION['user'],true);
  ?>
  <nav class="navbar navbar-expand-md navbar-dark">
    <a class="navbar-brand" href="/blog" style="font-family: Verdana, Geneva, Tahoma, sans-serif;letter-spacing: 4px;">BLOG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <?php if(isset($_SESSION['Auth'])) { ?>
          <li class="nav-item btn-nav active">
            <a class="nav-link" href="/blog"> <span class="sr-only">Records</span></a>
          </li>
          <?php if($user['role']  == 'Author') { ?>
            <li class="nav-item active">
              <div class="dropdown">
                <button class="btn  text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>My Records</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/blog/authorRecords?id=<?= $_SESSION['Auth'] ?>">My Records</a>
                  <a class="dropdown-item" href="/blog/create">Add Record</a>
                </div>
              </div>
            </li>
          <?php } ?>
        <?php if($user['role'] == 'Administrator') { ?> 
        <li class="nav-item active">
        <li class="nav-item active">
          <div class="dropdown">
            <button class="btn text-white dropdown-toggle" style="letter-spacing: 4px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin Panel
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/admin/records">Records</a>
              <a class="dropdown-item" href="/admin/comments">Comments</a>
              <a class="dropdown-item" href="/admin/users">Users</a>
            </div>
          </div>
        </li>
        </li>
        <?php } ?>
      <?php } ?>
      </ul>
      <div>
        <?php if(isset($_SESSION['Auth'])) { ?>
        <div class="btn-group">
          <a class="float-left" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/<?= $user['url_avatar'] ?>" class="rounded-circle " style="max-width: 50x; max-height: 50px;" alt="...">
          </a>
          <div class="float-left text-center">
            <p class=" text-light text-center ml-1 mt-2" ><?= $user['nick'] ?></p>
          </div>
          <div id="dropdown-menu" class="dropdown-menu dropdown-menu-right dropdown-background p-2 float-right" style="width: 250px;" aria-labelledby="dropdownMenu2">
            <div class="card dropdown-background">
              <img src="/<?= $user['url_avatar'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center" style="color: goldenrod"><?= $user['nick'] ?></h4>
                <p class="card-text text-center text-warning"><?= $user['email']?></p>
              </div>
            </div>
            <a href="/user/refresh?id=<?= $_SESSION['Auth'] ?>" class="w-100 mt-1 btn btn-grad">
              <span></span>  
              <span></span>  
              <span></span>  
              <span></span>  
              Refresh Role
            </a>
            <a href="/user/edit?id=<?= $_SESSION['Auth'] ?> " class="w-100 mt-1 btn btn-grad">
              <span></span>  
              <span></span>  
              <span></span>  
              <span></span>  
              Edit
            </a>
            <a href="/user/signOut" class="w-100 mt-1 btn btn-grad" >
              <span></span>  
              <span></span>  
              <span></span>  
              <span></span>  
              Sign out
            </a>
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
  if (isset($_SESSION['error'])) { ?>

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ERROR!</strong> <?= $_SESSION['error'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>

<?php unset($_SESSION['error']); } ?>

<?php if (isset($_SESSION['success'])) { ?>

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> <?= $_SESSION['success'] ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<?php unset($_SESSION['success']); }  ?>