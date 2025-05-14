<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;
use App\Models\PolylinesModel;
use App\Models\poygonsModel;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygons = new poygonsModel();
        $this->point = new PointsModel();
        $this->polyline = new PolylinesModel();
        $this->polygon = new poygonsModel();



    }

    public function points()
    {
        $points = $this->points->gejson_points();

        return response()->json($points);

    }

    public function point($id)
    {
        $point = $this->point->gejson_point($id);

        return response()->json($point);

    }

    public function Polylines()
    {
        $polylines = $this->polylines->gejson_Polylines();
        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function Polyline($id)
    {
        $polyline = $this->polyline->gejson_Polyline($id);
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }


    public function poygons()
    {
        $poygons = $this->polygons->gejson_poygons();

        return response()->json($poygons, 200, [],JSON_NUMERIC_CHECK);

    }

    public function poygon($id)
    {
        $poygon = $this->polygon->gejson_poygon($id);

        return response()->json($poygon, 200, [],JSON_NUMERIC_CHECK);

    }
}
