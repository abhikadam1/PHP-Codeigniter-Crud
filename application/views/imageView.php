<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Document</title>
</head>
<body>
    <h1>Upload Images</h1>
    <form method="post" action="<?php echo base_url('ImageController/imageUpload');?>" enctype="multipart/form-data">
        <input type="file" name="files[]" id="files" multiple=""/>
        <br /><br />
        <input type="text" name="alt_text" placeholder="Alt Text" />
        <br /><br />
        <input type="submit" name="upload" value="Upload" />
    </form>
        <br /><br />

    <h2>Image Gallery</h2>
    <!-- <?php foreach ($images as $key=>$value): ?>
        <img src="<?php echo base_url('uploads/' . $value['vImagePath']); ?>" alt="<?php echo $value['vAltText']; ?>" />
    <?php endforeach; ?> -->



    <table width="60%" class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Alt Text</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // print_r($arr);
            // die;
            foreach ($images as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php 
                            if(isset($value['vImagePath']) && !empty($value['vImagePath'])){
                        ?>
                        <img src="<?= base_url($value['vImagePath'])?>" height="100px" width="300px" alt="">
                        <?php 
                            }else{
                        ?>
                        <img src="" alt="No Image Found">
                        <?php 
                            }
                        ?>
                                

                    </td>
                    
                    <td>
                    <?php echo $value['vAltText']; ?>
                    </td>
                    
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>