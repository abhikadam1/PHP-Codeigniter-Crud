<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main" >
        <form action="<?php echo  base_url('Auth/productData')?>" method="post" >
            Product Name : <input type="text" name="name" id="name"><br>
            Product Id : <input type="text" name="pid" id="pid"><br>
            Specification : <input type="text" name="sp" id="sp"><br>
            Quantity : <input type="text" name="qnt" id="qnt"><br>
            Price : <input type="text" name="price" id="price"><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>