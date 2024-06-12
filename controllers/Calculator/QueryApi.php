<?php

namespace app\controllers\Calculator;

use app\controllers\Calculator\BuilderQuery\BuilderQuery;
use app\controllers\Calculator\BuilderQuery\ParamsQuery;

class QueryApi implements BuilderQuery
{
    private array $query;

    public function addObject(string $object)
    {
        $this->query["object"] = $object;
    }

    public function addAction(string $action)
    {
        $this->query["action"] = $action;
    }

    public function addParams(ParamsQuery $params)
    {
        $this->query["params"] = $params->getParams();
    }

    public function get() : array
    {
        return $this->query;
    }
}