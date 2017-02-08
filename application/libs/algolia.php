<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/10/2017
 * Time: 3:10 PM
 */

namespace App\Libs;


class Algolia
{
    private $client;

    private $index;

    public function __construct()
    {
        $this->client = new \AlgoliaSearch\Client("ML9F9II7WZ", "c061ab1a7ddea2708ba0c12ff53215fe");
        $this->index = $this->client->initIndex('index');
    }

    public function addObject($array)
    {
        $res = $this->index->addObject($array);
        $this->index->waitTask($res['taskID']);
        return true;
    }

    public function saveObject($array, $objId)
    {
        // update the record with objectID="myID1"
        // the record is created if it doesn't exist
        $array['objectID'] = $objId;
        $res = $this->index->saveObject($array);
        return $res;
    }
}