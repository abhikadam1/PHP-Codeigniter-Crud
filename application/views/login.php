<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="main" >
        <form action="<?php echo  base_url('Auth/loginData')?>" method="post" >
            Email : <input type="text" name="email" id="email"><br>
            Password : <input type="password" name="pass" id="pass"><br>
            <input type="submit" value="Login">
            <a href="<?php echo base_url('Auth/register_here')?>">Register Here</a>
        </form>
    </div>
</body>
</html>