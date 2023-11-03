<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main" >
        <form action="<?php echo  base_url('Auth/productData1')?>" method="post" >
            <input type="hidden" name="id" id="id" value="<?php echo $arr['0']['iId']?>">
            Product Name : <input type="text" name="name" id="name" value="<?= $arr['0']['vProductName']?>"><br>
            Product Id : <input type="text" name="pid" id="pid" value="<?= $arr['0']['iProductId']?>" ><br>
            Specification : <input type="text" name="sp" id="sp" value="<?= $arr['0']['vSpecification']?>" ><br>
            Quantity : <input type="text" name="qnt" id="qnt" value="<?= $arr['0']['iQuantity']?>" ><br>
            Price : <input type="text" name="price" id="price" value="<?= $arr['0']['fPrice']?>" ><br>
            <input type="submit" value="update Product">
        </form>
    </div>
</body>
</html>