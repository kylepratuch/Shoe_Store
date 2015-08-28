<?php
    class Brand
    {
        private $brand_name;
        private $id;

        //Construct Brand object:
        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        //Set and get object properties:
        function setBrandName($new_brand_name)
        {
            $this->brand_name = (string) $new_brand_name;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Save object to brands table:
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //GetAll objects stored in brands table:
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        //Clear all objects stored in brands table:
        static function deleteALl()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        //Associate a Brand object with a Store object:
        function addStore($new_store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES
                ({$this->getId()},
                {$new_store->getId()});
            ");
        }

        //Get Store objects associated with a Brand object:
        function getStores()
        {
            $results = $GLOBALS['DB']->query
                ("SELECT stores.* FROM
                    brands  JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                            JOIN stores ON (brands_stores.store_id = stores.id)
                    WHERE brands.id = {$this->getId()};"
                );

            $stores = array();

            foreach($results as $store) {
                $store_name = $store['store_name'];
                $store_id = $store['id'];
                $new_store = new Store($store_name, $store_id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        //Find a Brand object by its Id:
        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach ($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

















    }
?>
