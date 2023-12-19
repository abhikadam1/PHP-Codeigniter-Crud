<!DOCTYPE html>  
<html>  
<head>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('application/assets/login.js'); ?>"></script>
    <title>Login Form</title> 
    <style>
        table tr 
        {
            padding: 20px;
            margin: 20px;
        }

        table tr td {
            padding : 5px;
            margin : 5px;
        }
    </style>
</head>  
<body>  
    <h2 style="align:center">Welcome!</h2>
    <h2 id="msg"><h2>
    <form id="login_form" method="post">
        <table style="padding: 10px; margin:10px">
        <tr>
            <td>
                <lable>Email Id</label>
                <input type="text" name="email" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Password</label>
                <input type="password" name="password" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="login" value="Login" />
            </td>
        </tr>
        </table>
    </form>
 </body>  
</html> 