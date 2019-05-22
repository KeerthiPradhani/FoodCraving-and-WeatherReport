<?php 
    class BusDB extends SQLite3 {
        function __construct() {
            $this->open('bus.db');
        }
    }
?>
