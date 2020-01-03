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
                    ?>
                    <h1>Ticket</h1>
                    <?php
                    foreach ($data['ticket'] as $ticket)
                    {
                        echo $ticket->getTicketId() . $ticket->getTicketType(). $ticket->getEventType(). $ticket->getDate(). $ticket->getTime(). "<br>";
                    }
                    break;
                case "favorite":
                    ?>
                    <h1>Favorite</h1>

                    <?php
                    break;
            }
        ?>
    </section>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>