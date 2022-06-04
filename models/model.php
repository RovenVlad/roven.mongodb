<?php

// echo $category->findOne(['_id' => new MongoDB\BSON\ObjectId($id_category)])['name'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Model {
    private $collection;

    public function __construct() {
        $this->collection = (new MongoDB\Client())->online_shop->items;
    }

    public function getVendor() {
        return $this->collection->distinct("vendor");
    }

    public function getMissingItems() {
        return $this->collection->find(['quantity' => 0])->toArray();
    }

    public function getRange($from, $to) {
        return $this->collection->find(['price' => ['$gte' => filter_var($from, FILTER_VALIDATE_INT), '$lte' => filter_var($to, FILTER_VALIDATE_INT)]])->toArray();
    }
}

?>