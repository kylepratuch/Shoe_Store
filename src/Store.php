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
            $this->store_name = (string) $new_store_name;
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

        //Update a Store object's name:
        function update($new_store_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_store_name);
        }

        //Delete a single Store object from database:
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            // $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE id = {$this->getId()};");
        }

        //Associate a Store object with a Brand object:
        function addBrand($new_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES
                ({$new_brand->getId()},
                {$this->getId()});
            ");
        }

        //Get Brand objects associated with a Store object:
        function getBrands()
        {
            $results = $GLOBALS['DB']->query
                ("SELECT brands.* FROM
                    stores  JOIN brands_stores ON (stores.id = brands_stores.store_id)
                            JOIN brands ON (brands_stores.brand_id = brands.id)
                    WHERE stores.id = {$this->getId()};"
                );

            $brands = array();

            foreach($results as $brand) {
                $brand_name = $brand['brand_name'];
                $brand_id = $brand['id'];
                $new_brand = new Brand($brand_name, $brand_id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }








?>
