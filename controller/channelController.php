<?php 

require_once __DIR__ . '/../model/model.class.php';


class ChannelController
{
    public function mine()
    {

        $title = 'Vaši kanali';
        $user = User::where('username', '"' . $_SESSION['username'] . '"');
        $channelList = Channel::where('id_user', '"' . $user[0]->id . '"' );


        require_once __DIR__ . '/../view/channel_index.php';
    }

    public function all() {

        $title = 'Svi kanali';
        $channelList = Channel::all();

        require_once __DIR__ . '/../view/channel_index.php';

    }

    public function new() {

        if(isset($_POST['ime_kanala']) && preg_match('/^[A-Za-z0-9 -]+$/', $_POST['ime_kanala'])) {

            $novi_kanal = new Channel();
            $channelList = Channel::all();
            $novi_kanal->id = sizeof($channelList) + 1;
            $novi_kanal->id_user = User::where('username', '"' . $_SESSION['username'] . '"')[0]->id;
            $novi_kanal->name = $_POST['ime_kanala'];

            $novi_kanal->create();

            $this->mine();

        } else {

            require __DIR__ . '/../view/new_channel_index.php';

        }

    }

    

}

?>
