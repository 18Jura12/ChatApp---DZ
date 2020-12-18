<?php 

require_once __DIR__ . '/model.class.php';

class Message extends Model
{

    static protected $table = 'dz2_messages';
    static protected $attributes = ['id' => 'int', 'id_user' => 'int', 'id_channel' => 'int',
                                    'content' => 'string', 'thumbs_up' => 'int', 'date' => 'datetime'];

}

?>
