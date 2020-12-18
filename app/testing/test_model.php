<?php

    require_once __DIR__ . '/../../model/model.class.php';

    // $newUser = new Channel();
    // $newUser->id = 345678911;
    // $newUser->id_user = 15648;
    // $newUser->name = 'blabla';
    // $newUser->create();


    $ime = [];
    $ime['ime'] = 'ana';
    $userList = User::where('username', '"' . $ime['ime'] . '"');
    // $userList = User::all();
    $channelList = Channel::where('id_user', "'" . $userList[0]->id . "'");
    $messageList = Message::all();

    require_once __DIR__ . '/../../view/_header.php';

?>
<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>

    <?php
        foreach( $userList as $user )
        {
            echo '<tr>';
            echo '<td>' . $user->username . '</td>';
            echo '<td>' . $user->email . '</td>';
            echo '</tr>';
        }
    ?>
</table>

<table>
    <tr>
        <th>Name</th>
    </tr>

    <?php
        foreach( $channelList as $channel )
        {
            echo '<tr>';
            echo '<td>' . $channel->name . '</td>';
            echo '</tr>';
        }
    ?>
</table>

<table>
    <tr>
        <th>Content</th>
        <th>Date</th>
    </tr>

    <?php
        foreach( $messageList as $message )
        {
            echo '<tr>';
            echo '<td>' . $message->content . '</td>';
            echo '<td>' . $message->date . '</td>';
            echo '</tr>';
        }
    ?>
</table>

<?php

    require_once __DIR__ . '/../../view/_footer.php';

?>