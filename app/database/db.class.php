<?php

    class DB {
        
        // Interna statička varijabla koja čuva konekciju na bazu
        private static $db=null;
        
        // Zabranimo new DB() i kloniranje
        final private function __construct() { }
        final private function __clone() { }
        
        // Statička funkcija za pristup bazi.
        public static function getConnection() { 
            
            // Spoji se samo ako već nisi nekad ranije.
            if( DB::$db === null) {
                
                $user = 'student'; $pass = 'pass.mysql';

                try {

                    DB::$db = new PDO(
                        'mysql:host=rp2.studenti.math.hr;dbname=juric;charset=utf8mb4;',
                        $user, $pass);
                    DB::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    DB::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
                
                } catch(PDOException $e) {

                    echo "Greška: " . $e->getMessage(); exit();

                }
                
            }
            return DB::$db;
            
        }

    }

?>
