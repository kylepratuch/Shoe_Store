<?php
    class Store
    {
        private $store_name;
        private $id;

        //Construct Store object:
        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Set and get object properties:
        function setStoreName($new_store_name)
        {
            $this->name = (string) $new_store_name;
        }

        function getStoreName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Save object to stores table:
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //GetAll objects stored in stores table:
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach ($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        //Clear all objects stored in stores table:
        static function deleteALl()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }












    }



?>
