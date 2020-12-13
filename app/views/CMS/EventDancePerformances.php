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
    echo build_table($data['content'],[''], ['artist_name','venue_name'],true)
    ?>
    </body>
    </html>


<?php
?>