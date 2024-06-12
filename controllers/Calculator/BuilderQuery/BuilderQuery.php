<?php

namespace app\controllers\Calculator\BuilderQuery;

interface BuilderQuery
{
    public function addObject(string $object);
    public function addAction(string $action);
    public function addParams(ParamsQuery $params);
}