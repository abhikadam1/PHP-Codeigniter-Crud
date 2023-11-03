<html>

<head>
    <title>Insert Data </title>
    <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    <style>
        .f1{
            display: none;
        }

        #container {
            /* display: none; */
            width: 960px;
            height: 610px;
            margin: 50px auto
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: -15px
        }

        form {
            width: 345px;
            padding: 0 50px 20px;
            background: linear-gradient(#fff, #FF94BB);
            border: 1px solid #ccc;
            box-shadow: 0 0 5px;
            font-family: 'Marcellus', serif;
            float: left;
            margin-top: 10px
        }

        h1 {
            text-align: center;
            font-size: 28px
        }

        hr {
            border: 0;
            border-bottom: 1.5px solid #ccc;
            margin-top: -10px;
            margin-bottom: 30px
        }

        label {
            font-size: 17px
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 6px 0 20px;
            border: none;
            box-shadow: 0 0 5px
        }

        input#submit {
            margin-top: 20px;
            font-size: 18px;
            background: linear-gradient(#22abe9 5%, #36caf0 100%);
            border: 1px solid #0F799E;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            text-shadow: 0 1px 0 #13506D
        }

        input#submit:hover {
            background: linear-gradient(#36caf0 5%, #22abe9 100%)
        }
    </style>
</head>

<body>
    <form class="f1" action="add_stud_records" method="post" enctype="multipart/form-data">
        <label>Select Image File:</label>
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>


    <div id="container">
        <?php echo form_open_multipart('Students/add_stud_records');  ?>
        <h1>Insert Data</h1>
        <hr />
        <?php if (isset($message)) { ?>
            <CENTER>
                <h3 style="color:green;">Data inserted successfully</h3>
            </CENTER><br>
        <?php } ?>
        <?php echo form_label('Student Roll No. :'); ?>
        <?php echo form_error('s_roll_no'); ?><br />
        <?php echo form_input(array('id' => 's_roll_no', 'name' => 's_roll_no', 'placeholder' => 'Enter Roll No')); ?><br />

        <?php echo form_label('Student Name :'); ?>
        <?php echo form_error('s_stud_name'); ?><br />
        <?php echo form_input(array('id' => 's_stud_name', 'name' => 's_stud_name')); ?><br />

        <?php echo form_label('Student Address :'); ?>
        <?php echo form_error('s_address'); ?><br />
        <?php echo form_input(array('id' => 's_address', 'name' => 's_address')); ?><br />

        <?php echo form_label('Student Mobile_No. :'); ?>
        <?php echo form_error('s_mobile'); ?><br />
        <?php echo form_input(array('id' => 's_mobile', 'name' => 's_mobile', 'placeholder' => '10 Digit Mobile No.')); ?><br />

        <?php echo form_label('Student Age :'); ?>
        <?php echo form_error('s_age'); ?> <br />
        <?php echo form_input(array('id' => 's_age', 'name'=> 's_age')); ?><br />

        <?php echo form_label('Student Image :'); ?>
        <?php echo form_error('s_img'); ?> <br />
        <input type="file" name="s_img" id="s_img" required><br />

        <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
        <?php echo form_close(); ?><br />
        <div id="fugo">

        </div>
    </div>
</body>

</html>