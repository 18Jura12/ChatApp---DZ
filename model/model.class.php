<?php 

// Zadatak (srednje-dosta težak.)
// Ovo je samo kostur apstraktne klase Model.
// Trebate sami napisati implementaciju svih funkcija tako da rade kao što je opisano.
// Uputa: trebat ćete koristiti funkcije poput get_called_class(), kao i stvari poput $obj = new $className();
//
// Pogledajte i moguće dodatne funkcije i relacije ovdje:
// https://laravel.com/docs/master/eloquent
// https://laravel.com/docs/master/eloquent-relationships


require_once __DIR__ . '/../app/database/db.class.php';

spl_autoload_register( function ($class_name) 
{
    $fileName = __DIR__ . '/' . strtolower($class_name) . '.class.php';

    if( file_exists( $fileName ) === false )
        return false;

    require_once $fileName;

    return true;
} );


abstract class Model
{
    // Tablica u bazi podataka pridružena modelu. Svaka izvedena klase će definirati svoju.
    protected static $table = null;

    // Asocijativno polje $columns:
    // - ključevi = imena stupaca u bazi podataka u tablici $table;
    // - svakom ključu je pridružena vrijednost koja u bazi piše za objekt $this (onaj čiji je id jedak $this->id).
    protected $columns = [];
    protected static $attributes = [];

    public function __get( $col )
    {
        // Omogućava da umjesto $this->columns['name'] pišemo $this->name.
        // (uoči: $this->columns može ostati protected!)
        if( isset( $this->columns[ $col ] ) )
            return $this->columns[ $col ];

        return null;
    }

    public function __set( $col, $value )
    {
        // Omogućava da umjesto $this->columns['name']='Mirko' pišemo $this->name='Mirko'.
        // (uoči: $this->columns može ostati protected!)
        $this->columns[$col] = $value;

        return $this;
    }

    public static function all()
    {
        // TODO:
        // Funkcija vraća polje koje sadrži sve objekte iz tablice $table.
        $db = DB::getConnection();
        $class = get_called_class();
        $all = [];
        $q = $db->prepare('SELECT * FROM ' . $class::$table);
        $q->execute();
        $row = $q->fetch(PDO::FETCH_ASSOC);
        while($row !== false) {

            $newClass = new $class();
            $keys = array_keys($row);
            foreach($keys as $key) {

                $newClass->$key = $row[$key];

            }
            $all[] = $newClass;

            $row = $q->fetch(PDO::FETCH_ASSOC);

        }
        return $all;

    }

    public static function where( $column, $value )
    {

        // TODO:
        // Funkcija vraća polje koje sadrži sve objekte iz tablice $table kojima u stupcu $column piše vrijednost $value.
        $db = DB::getConnection();
        $class = get_called_class();
        $all = [];
        $q = $db->prepare('SELECT * FROM ' . $class::$table . ' WHERE ' . $column . '=' . $value);
        $q->execute();
        $row = $q->fetch(PDO::FETCH_ASSOC);
        while($row !== false) {

            $newClass = new $class();
            $keys = array_keys($row);
            foreach($keys as $key) {

                $newClass->$key = $row[$key];

            }
            $all[] = $newClass;

            $row = $q->fetch(PDO::FETCH_ASSOC);

        }
        return $all;


    }

    public function create()
    {

        // TODO
        // Funkcija sprema novi ili ažurira postojeći redak u tablici $table koji pripada objektu $this.
        // ($this->id je ključ u tablici $table).
        $db = DB::getConnection();
        $class = get_called_class();
        $row = $this->columns;
        foreach(array_keys($row) as $att) {

            if($class::$attributes[$att] !== 'int') {

                $row[$att] = '"' . $row[$att] . '"';
                

            }

        }
        $values = implode(', ', $row);
        $q = $db->prepare('DELETE FROM ' . $class::$table . ' WHERE id=' . $row['id']);
        $q->execute();
        $q = $db->prepare('INSERT INTO ' . $class::$table . ' VALUES (' . $values . ')');
        $q->execute();

    }
}

?>
