<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <style>
        .main {
            margin: auto;
            /* align-items: center; */
        }

        .image_list {
            margin: 10px 10px 10px 300px;
            /* margi */
        }

        .card_view {
            flex-wrap: wrap;
            display: flex;

        }

        .card {
            margin: 20px 20px 20px 20px;
            padding: 20px 20px 20px 20px;
            /* margin:auto;
            padding: auto; */
        }

        /* .heading_display {
            margin-left: 500px;
            padding: auto;
        } */
    </style>
</head>

<body>
    <!-- <?php $message = $this->session->flashdata('msg');
    // $this->session->unset_flashdata('error');
    if (isset($message) && !empty($message)) { ?>
        <CENTER>
            <h3 style="color:green;">
                <?= $message ?>
            </h3>
        </CENTER><br>
    <?php } ?> -->

    <div class="main">
        <div class="heading_display">
            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="100"
                height="100">
            <a href="<?= base_url('Assignment/Image_Upload_Controller/index') ?>"><button
                    class="btn-primary image_list">
                    Upload Image</button></a>
        </div>
        <div class="card_view">
            <?php
            if (is_array($arr) && count($arr) > 0) {

                foreach ($arr as $key => $value) {
                    ?>
                    <div class="card" style="width: 18rem;"  >
                        <img src="<?= base_url() . $value['vImagePath'] ?>"  height="250px" width="250px" class="card-img-top"
                            alt="<?= $value['vImageCaption'] ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $value['vUsername'] ?>
                            </h5>
                            <p class="card-text">
                                <?= $value['vImageCaption'] ?>.
                            </p>
                            <a href="<?= base_url().$value['vImagePath'] ?>" class="btn btn-primary" download>Download</a>
                            <!-- <a href="<?= $value['vImagePath'] ?>" download> <button>Download</button></a> -->
                        </div>
                    </div>
                <?php }
            } else {
                ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <?php
                        echo "No images found.";
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>