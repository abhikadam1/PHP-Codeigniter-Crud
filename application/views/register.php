<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main" >
        <form action="<?php echo  base_url('Auth/registerData')?>" method="post" >
            Name : <input type="text" name="name" id="name"><br>
            Email : <input type="text" name="email" id="email"><br>
            Password : <input type="password" name="pass" id="pass"><br>
            Mobile No.: <input type="number" name="mobNo" id="mobNo"><br>
            <input type="submit" value="Register"> <a href="<?php echo base_url('Auth/login_here')?>">Login Here</a>
        </form>
    </div>
</body>
</html>