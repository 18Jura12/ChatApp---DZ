<?php 

require_once __DIR__ . '/../model/message.class.php';

function sort_by_date_a($a, $b) {
    $a = strtotime($a->date);
    $b = strtotime($b->date);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

function sort_by_date_d($a, $b) {
    $a = strtotime($a->date);
    $b = strtotime($b->date);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? 1 : -1;
}

class MessageController
{
    public function user()
    {

        if(isset($_GET['uname'])) {

            $username = preg_replace('/@/', '', $_GET['uname']);
            if($username === $_SESSION['username']) {

                $title = 'Vaše poruke';

            } else {

                $title = 'Poruke korisnika ' . $username;

            }

        } else {

            $username = $_SESSION['username'];
            $title = 'Vaše poruke';

        }

        $user = User::where('username', '"' . $username . '"');
        
        if(sizeof($user) === 0) {

            echo 'Korisnik "' . $username . '" ne postoji. Prikazujemo Vaše poruke.';
            $user = User::where('username', '"' . $_SESSION['username'] . '"');

        }

        $messageList = Message::where('id_user', $user[0]->id );
        uasort($messageList, 'sort_by_date_d');

        require_once __DIR__ . '/../view/message_index.php';
    
    }


    public function channel()
    {

        $id_channel = $_GET['id_channel'];
        $title = 'Kanal ' . Channel::where('id', '"' . $id_channel . '"')[0]->name; 
        $messageList = Message::where('id_channel', $id_channel);
        uasort($messageList, 'sort_by_date_a');

        require_once __DIR__ . '/../view/message_index.php';
    }


    public function like() {

        $message = Message::where('id', $_GET['channel_id']);
        $message[0]->thumbs_up = $message[0]->thumbs_up + 1;
        $message[0]->create();

        $this->channel();

    }


    public function new() {

        if(isset($_POST['content']) && !preg_match('/^.*[;"].*$/', $_POST['content']) && !ctype_space($_POST['content'])) {

            $user = User::where('username', '"' . $_SESSION['username'] . '"');
            $messageList = Message::all();
            $new_message = new Message();
            $new_message->id = sizeof($messageList) + 1;
            $new_message->id_user = $user[0]->id;
            $new_message->id_channel = $_GET['id_channel'];
            $new_message->content = $_POST['content'];
            $new_message->thumbs_up = 0;
            $new_message->date = date("Y-m-d H:i:s");

            $new_message->create();

        } else {

            echo '<b>Neispravno napisana poruka (ne smije sadržavati ";" i dvostruke navodnike te ne smije biti prazna)!</b>';

        }

        $this->channel();

    }


}

?>
