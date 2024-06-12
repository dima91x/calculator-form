<?php

namespace app\controllers\Calculator;

use app\controllers\Calculator\BuilderQuery\ParamsQuery;
use app\controllers\Calculator\BuilderQuery\RoutePointType;

class Price extends ObjectApi
{
    public function getPrice( $info, string $terminal = "default") : array
    {
        $query = new QueryApi();
        $query->addObject("price");
        $query->addAction("get");

        $params = new ParamsQuery();
        $params->addCargoDimension($info["volume"], $info["weight"]);
        $params->addRoutePoint(RoutePointType::Dispatch, $info["from"]);
        $params->addRoutePoint(RoutePointType::Destination, $info["to"]);
        $query->addParams($params);

        return $this->requestApi($query->get());

    }
}