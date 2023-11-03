<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <button>Image List</button>

        <div class="image_upload" >
            <h4>Image Upload</h4>
            <form action="" method="post">
                <label for="username">Your Name</label>
                <input type="text" name="username" id="username">
                <label for="img">Image</label>
                <input type="file" name="" id="">
            </form>

        </div>

    </div>
</body>
</html> -->

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .main {
            margin: auto;
            /* align-items: center; */
        }

        .image_list {
            margin: 10px 10px 10px 300px;
            /* margi */
        }

        /* .img_pr {
            margin: auto;
        } */

        .valid {
            display: flex;
            /* margin: 10px 10px 10px 10px; */
            /* margi */
        }

        .icon_div {
            /* width: 655px; */
            margin: auto;
            padding-left: 10px;
        }

        .form_div {
            display: flex;
            /* width: 655px; */
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="main">
        <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="100"
            height="100">

        <a href="<?= base_url('Assignment/Image_Upload_Controller/getImageList') ?>"><button
                class="btn-primary image_list">
                Image List</button></a>

        <main class="form-signin">
            <h3>Upload Image</h3>
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
            <div class="form_div">
                <?php echo form_open_multipart('Assignment/Image_Upload_Controller/uploadImage', 'id="form"'); ?>

                <div class="form-floating">
                    <input type="text" name="e_name" class="form-control" id="e_name" placeholder="Your Name" required>
                    <label for="floatingInput">Your Name</label>
                </div>

                <div class="valid form-floating">
                    <input type="file" name="e_img" class="form-control" id="e_img" placeholder="Image" required>
                    <label for="floatingPassword"></label>
                    <div class="icon_div" title="Only Upload jpeg and png files" >
                        <i class="fa fa-question-circle" style="font-size:18px"></i>
                    </div>
                </div>

                <div class="img_pr">
                    <img id="imagePreview" src="#" alt="Image Preview"
                        style="display: none; max-width: 250px; max-height: 250px;">
                </div>

                <div class="form-floating">
                    <input type="text" name="caption" class="form-control" id="caption" placeholder="Image Caption"
                        required>
                    <label for="floatingInput">Image Caption</label>
                </div>

                <button class=" w-100 btn btn-lg btn-primary" type="submit">Upload</button>
                </form>
            </div>
        </main>
    </div>
</body>
<script>
     // Function to handle image extension type
    $(document).ready(function () {
        $('#e_img').change(function () {
            var fileName = $(this).val();
            var fileExt = fileName.split('.').pop().toLowerCase();
            var allowedExts = ['jpeg', 'png'];

            if ($.inArray(fileExt, allowedExts) === -1) {
                alert('Invalid file type. Please select a valid image file jpeg, png.');
                $(this).val('');
            }
        });

        // Function to handle image preview
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Trigger the preview function when the file input changes
        $('#e_img').change(function () {
            previewImage(this);
        });
       
    });
</script>

</html>