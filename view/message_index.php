<?php require_once __DIR__ . '/_header.php'; ?> 

<h3 id="naslov1"><b><?php echo $title; ?></b> </h3>

<hr>

<table id="poruke">
    <tr >
         <th>Korisnik</th>
         <th>Poruka</th>
    </tr>

    <?php
        foreach( $messageList as $message )
        {
            echo '<tr>';
            echo '<td id="user"><b>' . User::where('id', $message->id_user)[0]->username . '<b></td>';
            echo '<td id="tekst">' . preg_replace('/@[A-Za-z0-9]{3,20}/', '<a href=chat.php?rt=message/user&uname=$0>$0</a>', $message->content) .
                 '<div id="datum">' . $message->date . '</div>' . '</td>';
            if(!isset($_GET['id_channel']) && !isset($_GET['id'])) {

                $channel_name = Channel::where('id', '"' . $message->id_channel . '"')[0]->name;
                echo '<td><button id="k"><a href=chat.php?id_channel=' . $message->id_channel . '&rt=message/channel>' . $channel_name .'</a></button></td>';

            } else {

               ?>
                <td>
                <form action="chat.php?rt=message/like&channel_id=<?php echo $message->id; ?>&id_channel=<?php echo $_GET['id_channel']; ?>" method="post">
                    <button type="submit" id="gumb"><b><?php echo $message->thumbs_up; ?></b> &#128077;</button>
                </form>
                </td>
               <?php

            }
            echo '</tr>';
        }
    ?>
</table>

<?php
if(isset($_GET['id_channel'])) {

    ?>
    <br>
    <form action="chat.php?rt=message/new&id_channel=<?php echo $_GET['id_channel']; ?>" method="post" id="nova">
        <b>Nova poruka:</b>
        <input type="text" name="content" class="npor">
        <button type="submit" id="nk">Pošalji!</button>
    </form>
    <?php

}

require_once __DIR__ . '/_footer.php'; ?>
