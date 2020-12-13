<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo URLROOT."/public/css/style.css";?>">
        <title><?php echo $data["title"];   ?></title>
    </head>

    <body>
    <?php
    echo build_table($data['content'],['kitchen1','kitchen2','price','info_page','rest_img'])
    ?>
    </body>
    </html>


<?php
?>