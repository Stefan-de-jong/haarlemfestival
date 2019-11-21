<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Info & reservate</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/food.css">
</head>
<body>
<div class="container">
    <a href="">Home </a> >  <a href="index.php">Restaurant overview </a> > Info & reservate
    <article>
        <h1>The golden bull</h1>
        <img class="rest_img "src="img/goldenbull.jpg">
        <p>
            About the restaurant: <a href="https://www.mlinhaarlem.nl">mlinhaarlem.nl</a><br>
            <br>
            Kitchen: Restaurant ML is a 4 star Dutch, fish and seafood, European restaurant.<br>
            <br>
            Prices: A reservation fee of €10,- per person wil be charged. <br>
            This fee will be deducted from the final check on visiting the restaurant.<br>
            <br>
            The restaurants prices are:<br>
            Regular ticket: €45,00*<br>
            Kids ticket: €22,50*<br>
            <br>
            * Total price = reservation fees + meal costs(13+: € 35,- , child: € 12,50)<br>
            Beverage costs are not included in the total price.<br>
            Meal costs must be paid in the restaurant.<br>
            <br>
            Adres: Kleine Houtstraat 70, 2011 DR Haarlem, Netherlands.<br>
        </p>
    </article>
    <br>

        <iframe width="425" height="350" frameborder="1"  src="https://maps.google.com/maps?q=The%20golden%20bull%20haarlem&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

    <section class="avaibility">
            <h2>Restaurant availabilty:</h2>
            Date:
            <select>
                <option value="">Thursday 26 Juli</option>
                <option value="">Friday 27 Juli</option>
                <option value="">Saturday 28 Juli</option>
                <option value="">Sunday 29 Juli</option>
            </select>

        <table border="1" width="425">
           <tr>
               <th>
                   Session 1
               </th>
               <th>
                   Session 2
               </th>
               <th>
                   Session 3
               </th>
           </tr>
            <tr>
               <td>
                   17:30-19:00
               </td>
               <td>
                   19:00-20:30
               </td>
                <td>
                    20:30-22:00
                </td>
           </tr>
            <tr>
                <td>
                    Seats available: 60
                </td>
                <td>
                    Seats available: 60
                </td>
                <td>
                    Seats available: 60
                </td>
            </tr>
        </table>
        <br>
        <button>Make your reservation</button>
    </section>
</div>
</body>

</html>