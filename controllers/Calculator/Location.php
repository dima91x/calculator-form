<?php

namespace app\controllers\Calculator;

class Location extends ObjectApi implements GetObjects
{
    private array $list;
    private array $data;

    public function getObjectsFromApi() : GetObjects
    {
        $data = [
            "object" => "location",
            "action" => "get"
        ];

        $this->data = $this->requestApi($data);
        return $this;
    }

    public function listLocation() : self
    {
        $locations = $this->data["response"]["data"];
        $arr_locations = array_column($locations, "name");
        $this->list = array_combine($arr_locations, $arr_locations);
        return $this;
    }

    public function toArray() : array
    {
        return $this->list;
    }
}