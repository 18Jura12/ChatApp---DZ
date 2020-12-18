<?php 

require_once __DIR__ . '/../model/user.class.php';

class UsersController
{
    public function login() {

        $title = 'Chat';

        if(isset($_SESSION['username'])) {

            session_destroy();

        }

        require_once __DIR__ . '/../view/log_in_index.php';

    }

    public function validate() {

        if(!isset($_POST['username']) || !isset($_POST['password'])) {

            $this->login();

        } else {

            $user = User::where('username', '"' . $_POST['username'] .'"');
            if(sizeof($user) !== 1) {

                echo '<div id="forma"><b>Kriva šifra ili korisničko ime.</b></div>';

                require_once __DIR__ . '/../view/log_in_index.php';

            } else {

                if(password_verify($_POST['password'], $user[0]->password_hash)) {

                    if($user[0]->has_registered === 0) {

                        echo '<div id="forma"><b>Niste potvrdili registraciju. Provjerite svoj E-mail!</b></div>';

                        require_once __DIR__ . '/../view/log_in_index.php';

                    } else {

                        $_SESSION['username'] = $user[0]->username;
                    
                        $title = 'Vaši kanali';
                        $user = User::where('username', '"' . $_SESSION['username'] . '"');
                        $channelList = Channel::where('id_user', '"' . $user[0]->id . '"' );

                        require_once __DIR__ . '/../view/channel_index.php';

                    }

                } else {

                    echo '<div id="forma"><b>Kriva šifra ili korisničko ime.</b></div>';

                    require_once __DIR__ . '/../view/log_in_index.php';

                }

            }

        }

    }

    public function regValidate() {

        if(!isset($_POST['usname']) || !isset($_POST['pass'])) {

            require_once __DIR__ . '/../view/register_index.php';

        }else if(!preg_match('/^[A-Za-z0-9]{3,20}$/', $_POST['usname']) || !preg_match('/^[A-Za-z0-9]{3,20}$/', $_POST['pass'])) {

            echo '<div id="forma"><b>Nepodržan format za ime ili prezime (dozvoljeni samo slova i brojke, te duljina između 3 i 20).</b></div>';
            require_once __DIR__ . '/../view/register_index.php';

        } else {

            $user = User::where('username', '"' . $_POST['usname'] .'"');
            if(sizeof($user) !== 0) {

                if($user[0]->has_registered === 0) {

                    echo '<div id="forma"><b>Mail već poslan; molim potvrdite registraciju!</b></div>';
                    require_once __DIR__ . '/../view/log_in_index.php';

                } else {

                    echo '<div id="forma"><b>Korisničko ime je već zauzeto.</b></div>';
                    require_once __DIR__ . '/../view/register_index.php';

                }

            } else {

                $user = User::all();
                $reg_seq = '';
                for( $i = 0; $i < 20; ++$i ) {
                    
                    $reg_seq .= chr( rand(0, 25) + ord( 'a' ) );
                
                }

                $novi = new User();
                $novi->id = sizeof($user) + 1;
                $novi->username = $_POST ['usname'];
                $novi->password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $novi->email = $_POST['mail'];
                $novi->registration_sequence = $reg_seq;
                $novi->has_registered = 0;

                $novi->create();

                $to       = $_POST['mail'];
                $subject  = 'Registracijski mail';
                $message  = 'Poštovani ' . $_POST['usname'] . "!\nZa dovršetak registracije kliknite na sljedeći link: ";
                $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/chat.php?rt=users/finishReg&niz=' . $reg_seq . "\n";
                $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
                            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                $isOK = mail($to, $subject, $message, $headers);

                if( !$isOK ) {

                    exit( 'Greška: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );

                } else {

                    require_once __DIR__ . '/../view/log_in_index.php';

                    echo '<div id="forma"><b>Provjerite mail! &#128113;</b></div>';

                }

            }

        }

    }

    public function finishReg() {

        $novi = User::where('registration_sequence', '"' . $_GET['niz'] . '"');
        $novi[0]->has_registered = 1;

        $novi[0]->create();

        require_once __DIR__ . '/../view/log_in_index.php';
        echo '<div id="forma"><b>Hvala na registraciji! Sada se možete prijaviti..</b></div>';

    }

    public function register() {

        require_once __DIR__ . '/../view/register_index.php';

    }

}

?>
