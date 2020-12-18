<?php 

require_once __DIR__ . '/model.class.php';

class Channel extends Model
{

    static protected $table = 'dz2_channels'; 
    static protected $attributes = ['id' => 'int', 'id_user' => 'int', 'name' => 'string'];
    
}

?>
