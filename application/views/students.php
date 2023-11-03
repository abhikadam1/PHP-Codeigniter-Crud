<?php
// echo "<per>";
// echo "abhi. <br>";
// print_r($arr);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
        .view {
            display: none;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        .popup img {
            max-width: 500px;
            max-height: 500px;
            margin: 5% auto;
            display: block;
        }

        .close-button {
            /* margin: 10px; */
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 100px;
            color: #fff;
        }
    </style>
</head>

<body class="body">
    <button id="view_btn">Display View</button><br>

    <button><a href="<?= base_url() ?>Students/add_form">ADD Student</a></button>
    <table width="60%" class="table table-bordered">
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Age</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
                <th class="view">View</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // print_r($arr);
            // die;
            if (is_array($arr) && count($arr) > 0) {
                foreach ($arr as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['iStud_Roll_No']; ?>
                        </td>
                        <td>
                            <?php echo $value['vStud_Name']; ?>
                        </td>
                        <td>
                            <?php echo $value['vStud_Address']; ?>
                        </td>
                        <td>
                            <?php echo $value['iStud_Phone_No']; ?>
                        </td>
                        <td>
                            <?php echo $value['iAge'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($value['vImage']) && !empty($value['vImage'])) {
                                ?>
                                <img id="imageToPopup" src="<?= base_url($value['vImage']) ?>" height="100px" width="100px" alt="Image" onclick="showPopup()">
                                <div class="popup" id="imagePopup">
                                    <span class="close-button" onclick="closePopup()">&times;</span>
                                    <img src="<?= base_url($value['vImage']) ?>" alt="Image in popup">
                                </div>




                                <!-- <img src="<?= base_url($value['vImage']) ?>" height="100px" width="100px" alt=""> -->
                                <?php
                            } else {
                                ?>
                                <img src="" alt="No Image Found">
                                <?php
                            }
                            ?>


                        </td>
                        <td>
                            <button><a href="Students/edit/<?= $value['iStudInfoId'] ?>">Edit</a></button>
                        </td>
                        <td>
                            <button><a href="<?= base_url() ?>Students/delete/<?php echo $value['iStudInfoId'] ?>"
                                    class="delete" onclick="return confirm('Are you sure?')">Delete</a></button>
                        </td>

                        <td class="view">
                            <button><a href="view.php">view</a></button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <!-- <div class="card" style="width: 18rem;">
                        <div class="card-body"> -->
                    <?php
                    echo "No images found.";
                    ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
<script>
    $(document).ready(function () {
        const baseUrl = '<?php echo base_url() ?>';
        console.log(baseUrl);

        $('.edit_btn').on('click', function () {
            console.log($('.edit_btn').data('id'));

            const params = {
                'id': $('.edit_btn').data('id')
            }
            $.ajax({
                url: baseUrl + "Students/edit",
                data: params,
                method: "post",
                success: function () {

                }
            })
        })

        $('#view_btn').on('click', function () {
            const params = {
                'baseUrl': baseUrl
            };
            $.ajax({
                url: baseUrl + "Students/viewColumn",
                method: "post",
                data: params,
                success: function (response) {
                    data = JSON.parse(response);
                    // console.log(data);
                    // console.log(data[0].success, "pjrpjpr");
                    if (data[0].success == 'yes') {
                        $('.view').css('display', 'block');
                    }
                }
            });
            // $('.view').css('display', 'block');
        })
    })


    function showPopup() {
        var popup = document.getElementById("imagePopup");
        popup.style.display = "block";
    }

    function closePopup() {
        var popup = document.getElementById("imagePopup");
        popup.style.display = "none";
    }

</script>

</html>