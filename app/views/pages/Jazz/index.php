<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="blue_bg">     
<div class="emptyspace">
    <div class="white_text">
    <div class="firstimage">
       
        <h1>
            All access passes
        </h1>
        <img src="<?php echo URLROOT;?>/img/jazz/JazzImage1.png" alt="JazzGuy">
    <article>
        For each day, an all access pass will be available. With this pass you can go to all shows on a day. See tickets for a specific day to order. We also offer a all access pas that allows access to all shows on the three days. This will be available under tickets of the days below
    </article>
    <p></p>
    <h1>
        Thursday 26 July
    </h1>
    <article>
        The first day will start off in the Patronaat with the first Gumbo Kings and wicked Jazz sounds at 18:00. The last show ends 22:00 with Jonna Frazer and Ntjam Rosie. For more details about the artists, times and tickets click the button below.
    </article>
    <form action="jazztickets" method="post">
    <input
		type="submit"
		value="See tickets..."
        class="SeeTickets"
        name="thursday"
    />
    <h1>
        Friday 27 July
    </h1>
    <article>
        On the second day we start with Fox and the Mayors and Miles Sanko on 18:00. Our final show of the evening will be The Family XL and Chris Allen until 22:00
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        name="friday"
    />
    <div class="firstimage">
    <h1>
        Saturday 28 July
    </h1>
    <img src="<?php echo URLROOT;?>/img/jazz/JazzImage2.png" alt="JazzGuy">
    </div>
    <article>
        This day will start with Gare du Nord and Han Bennink at 18:00 in the Patronaat and wil end at 22:00 with Soul Six and Lilith Merlot
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        name="saturday"
	/>
    <h1>
        Sunday 29 July
    </h1>
    <article>
        The jazz events on this day will be free entry for everybody and will all take place on the 'Grote markt'. The first event starts 15:00 with Ruis Soundsystem and ends 21:00 with Gare du Nord.
    </article>
    <input
		type="submit"
		value="See tickets..."
		class="SeeTickets"
        name="sunday"
    />
    </form>
</div>
</div>
</div>
</div>
</body>
</html>