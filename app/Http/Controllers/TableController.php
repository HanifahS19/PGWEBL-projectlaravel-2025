<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolylinesModel;
use App\Models\poygonsModel;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->poygons = new poygonsModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Table',
            'points'=>$this->points->all(),

        ];
        return view('table', $data);
    }
}
