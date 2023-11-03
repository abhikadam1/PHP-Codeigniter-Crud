<?php 
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Signin Template · Bootstrap v5.0</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#7952b3">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <h3>Add Employee</h3>
    <hr />
    <?php $message = $this->session->flashdata('msg');
    // $this->session->unset_flashdata('error');
    if (isset($message) && !empty($message)) { ?>
        <CENTER>
            <h3 style="color:red;">
                <?= $message ?>
            </h3>
        </CENTER><br>
    <?php } ?>
    <!-- <form method="POST" action="<?= base_url('Assignment/User_Controller/employeeRegister')?>"> -->
    <?php echo form_open_multipart('Assignment/User_Controller/employeeRegister', 'id="form"'); ?>
      <!-- <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="52"
        height="40"> -->
      <!-- <h3 class="h3 mb-3 fw-normal">Register</h3> -->

      <div class="form-floating">
        <input type="text" name="e_code" class="form-control" id="e_code" placeholder="Employee Code" required>
        <label for="floatingInput">Employee Code</label>
      </div>
      <div class="form-floating">
        <input type="text" name="e_name" class="form-control" id="e_name" placeholder="Employee Name" required>
        <label for="floatingInput">Employee Name</label>
      </div>
      <div class="form-floating">
        <input type="number" name="e_age" class="form-control" id="e_age" placeholder="Employee Age" required>
        <label for="floatingInput">Employee Age</label>
      </div>
      <div class="form-floating">
        <input type="number" name="e_contact" class="form-control" id="e_contact" placeholder="Employee Contact No" required>
        <label for="floatingPassword">Employee Contact No</label>
      </div>
      <div class="form-floating">
        <input type="text" name="e_dept" class="form-control" id="e_dept" placeholder="Employee Department" required>
        <label for="floatingInput">Employee Department</label>
      </div>
      <div class="form-floating">
        <input type="number" name="e_salary" class="form-control" id="e_salary" placeholder="Employee Salary" required>
        <label for="floatingInput">Employee Salary</label>
      </div>
      <div class="form-floating">
        <input type="email" name="e_email" class="form-control" id="e_email" placeholder="Employee Emailz" required>
        <label for="floatingPassword">Employee Email</label>
      </div>
      <div class="form-floating">
        <input type="file" name="e_img" class="form-control" id="e_img" placeholder="Employee Image" required>
        <label for="floatingPassword"></label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <!-- <a href="<?= base_url('Assignment/User_Controller/loginForm')?>">Login Here</a> -->
        </label>
      </div>
      <button class=" w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </form>
  </main>

</body>

</html>
