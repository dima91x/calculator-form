<?php

namespace app\controllers\Calculator\BuilderQuery;

class ParamsQuery
{
    private array $params;

    private function addCargo(array $cargo)
    {
        $this->params["cargo"] = $cargo;
    }

    private function addGateway(array $gateway)
    {
        foreach ($gateway as $key => $value)
            $this->params["gateway"][$key] = $value;
    }

    public function addCargoDimension(float $volume = 0.1, float $weight = 0.1, int $quantity = 1)
    {
        $dimension = compact("quantity", ["volume", "weight"]);

        $this->addCargo(["dimension" => $dimension]);
    }

    public function addRoutePoint(RoutePointType $point, string $location, string $terminal = "default")
    {
        match($point)
        {
            RoutePointType::Dispatch => $routePointType = "dispatch",
            RoutePointType::Destination => $routePointType = "destination"
        };
        $gateway[$routePointType] = ["point" => compact("location", ["terminal"])];

        $this->addGateway($gateway);
    }

    public function getParams(): array
    {
        return $this->params;
    }

}