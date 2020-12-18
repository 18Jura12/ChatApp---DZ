<?php require_once __DIR__ . '/_header.php'; ?> 

<h3 id="naslov2"><b><?php echo $title; ?></b> </h3>

<hr>

<table id="kanali">

    <?php
        foreach( $channelList as $channel )
        {
            echo '<tr>';
            echo '<td><a href=chat.php?id_channel=' . $channel->id . '&rt=message/channel>' . $channel->name . '</a></td>';
            echo '</tr>';
        }
    ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>

