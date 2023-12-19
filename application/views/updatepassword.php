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
    <!--  -->
    <form id="updatepassword" method="post" action="<?php echo base_url().'index.php/login/updatepassword' ?>"> 
        <table>
        <tr>
            <td>
                <lable>Old password</label>
                <input type="text" name="old_password" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <lable>New password</label>
                <input type="text" name="new_password" value=''>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Change"/>
            </td>
        </tr>
        </table>
    </form>


 </body>  
</html> 