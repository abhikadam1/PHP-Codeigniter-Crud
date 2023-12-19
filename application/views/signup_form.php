<!DOCTYPE html>  
<html>  
<head>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('application/assets/login.js'); ?>"></script>

    <title>Sign up Form</title> 
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
    <!-- action="<?php echo base_url().'index.php/welcome/signup' ?>" -->
    <form id="signupForm" method="post" > 
        <table style="padding: 10px; margin:10px">
        <tr>
            <td>
                <lable>First Name</label>
                <input type="text" name="first_name" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Last Name</label>
                <input type="text" name="last_name" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Email</label>
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
                <input type="submit" name="submit" value="Sign up"/>
            </td>
        </tr>
        </table>
    </form>


 </body>  
</html> 