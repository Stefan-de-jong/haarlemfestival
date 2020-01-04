<?php require APPROOT . '/views/inc/header.php'; ?>

<section id="profile_body">
    <ul>
        <li><a href="<?php echo URLROOT; ?>/profile">Profile</a></li>
        <li><a href="<?php echo URLROOT; ?>/profile/ticket">Ticket</a></li>
        <li><a href="<?php echo URLROOT; ?>/profile/favorite">Favorite</a></li>
    </ul>
    <section id="content_section">
        <?php
            switch ($data['content'])
            {
                case "index":
                    ?>
                    <h1>Profile</h1>
                    <p>On your profile you can find the tickets you bought an the favorites you have saved.</p>
                    <?php
                    break;
                case "ticket":
                    if (!empty($data['foodTicket'])) {
                        echo "<h4> Food tickets:</h4>";
                        foreach ($data['foodTicket'] as $ticket) {
                            $date = date_create($ticket->getDate());
                            echo "Ticket type: " . $ticket->printTicketType() . "<br> 
                        Restaurant: " . $ticket->getRestName() . "<br> Date: " . date_format($date, "d F Y") . " Session: " . $ticket->getSession() . "<br>
                        <br>";
                        }
                    }
                    //historic
                    //dance
                    break;
                case "favorite":
                    if (!empty($data['foodFavorite'])) {
                    echo "<h4> Food favorites:</h4>";
                        foreach (  $data['foodFavorite'] as $favorite) {
                            $date = date_create($favorite->getDate());
                            echo  "Date: ".date_format($date, "d F Y")."<br>Restaurant: ". $favorite->getRestName() ."<br>Session: ". $favorite->getSession()."<br><br>";
                        }
                    }
                    break;
            }
        ?>
    </section>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>