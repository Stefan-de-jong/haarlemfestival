<?php require APPROOT . '/views/inc/header.php'; ?>
<html lang=en>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/jazz.css">
</head>
<body class="blue_bg">
    <div class="white_text">
    <div class="firstimage">
        <h1>
            Day 1
        </h1>
        <img src="image1.png" class="image" alt="JazzGuy" title="Hi am test">
    </div>
    <article>
        <?php /*AllAccessDiscription*/ echo "lorem ipsum;" ?>
    </article>
    <h1>
        Header 2
    </h1>
    <article>
        <?php /*DayOneDiscription*/ echo "lorem ipsum;" ?>
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        onclick="window.location.href='jazzTickets'"
	/>
    <h1>
        Header 3
    </h1>
    <article>
        <?php /*DayTwoDiscription*/ echo "lorem ipsum;" ?>
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        onclick="window.location.href='jazzTickets'"
	/>
    <h1>
        Header 4
    </h1>
    <article>
        <?php /*DayThreeDiscription*/ echo "lorem ipsum;" ?>
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        onclick="window.location.href='jazzTickets'"
	/>
    <h1>
        Header 5
    </h1>
    <article>
        <?php /*DayFourDiscription*/ echo "lorem ipsum;" ?>
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        onclick="window.location.href='jazzTickets'"
    />
</div>
</div>
</body>
</html>