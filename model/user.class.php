<?php 

require_once __DIR__ . '/model.class.php';

class User extends Model
{

    static protected $table = 'dz2_users';  
    static protected $attributes = ['id' => 'int', 'username' => 'string', 'password_hash' => 'string',
                                    'email' => 'string', 'registration_sequence' => 'string', 'has_registered' => 'int'];

}

?>
