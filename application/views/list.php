<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <title>CRUD_application - view</title>
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">CRUD_application</a>
        </div>
    </div>
    <div class="container" style="padding-top:10px">
    <div class="row">
        <div class="col-md-12">
            <?php
            $success = $this -> session -> userdata('success');
            if($success != ""){
                ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
                <?php 
                 }
                ?>
            <?php
            $failure = $this -> session -> userdata('failure');
            if($failure != ""){
                ?>
                <div class="alert alert-success"><?php echo $failure; ?></div>
                <?php 
                 }
                ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
        <div class="row">
            <div class="col-md-6"> <h3>View users</h3></div>
                  <div class="col-md-6 text-right">
                     <a href="<?php echo base_url().'index.php/user/create/';?>" class="btn btn-primary">Create</a>
        </div>
        </div>
        </div>   
        <hr>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                        <?php if(!empty($users)) { foreach ($users as $user) {?>
                
                  
                    <tr>
                        <td><?php echo $user['id']?></td>
                        <td><?php echo $user['name']?></td>
                        <td><?php echo $user['email']?></td>
                        <td><a href="<?php echo base_url().'index.php/user/edit/'.$user['id']?>" class="btn btn-primary">Edit</a></td>
                        <td><a href="<?php echo base_url().'index.php/user/delete/'.$user['id']?>" class="btn btn-danger">Delete</a></td>
                         
                    </tr>
                    <?php } } else {  ?>
                        <tr>
                            <td colspan="5">Records not found</td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
</body>
</html>