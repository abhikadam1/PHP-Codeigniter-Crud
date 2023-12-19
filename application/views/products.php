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

</head>

<body class="body">
    <?php ?>
    <button><a href="<?= base_url() ?>Auth/add_product">ADD Product</a></button>
    <table width="60%" class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Specification</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($arr as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['vProductName']; ?>
                    </td>
                    <td>
                        <?php echo $value['vSpecification']; ?>
                    </td>
                    <td>
                        <?php echo $value['iQuantity']; ?>
                    </td>
                    <td>
                        <?php echo $value['fPrice']; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('Auth/edit/')?><?php echo $value['iId'] ?>">Edit</a>
                    </td>
                    <td>
                        <button><a href="<?= base_url() ?>Auth/delete/<?php echo $value['iId'] ?>"   class="delete" onclick="return confirm('Are you sure?')">Delete</a></button>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
<script>
    $(document).ready(function(){
        const baseUrl = '<?php echo base_url()?>';
        console.log(baseUrl);

        $('.edit_btn').on('click', function(){
            console.log($('.edit_btn').data('id'));

            const params ={
                'id' : $('.edit_btn').data('id')
            }
            $.ajax({
                url:baseUrl+"Students/edit",
                data: params,
                method: "post",
                success: function(){

                }
            })
        })
        
        $('#view_btn').on('click', function(){
            const params = {
                'baseUrl':baseUrl
            };
            $.ajax({
                url: baseUrl+"Students/viewColumn",
                method: "post",
                data: params,
                success: function(response){
                    data = JSON.parse(response);
                    // console.log(data);
                    // console.log(data[0].success, "pjrpjpr");
                    if(data[0].success == 'yes'){
                        $('.view').css('display', 'block');
                    }
                } 
            });
            // $('.view').css('display', 'block');
        })
    })
</script>
</html>