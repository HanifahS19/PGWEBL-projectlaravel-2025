<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;


class pointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map', // objek
        ];

        return view('map', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untukmeangkap data dari form dan memasukan data ke database melalui model. menambah data baru

        $data=[
            'geom' =>$request->geom_point,
            'name' =>$request->name,
            'description' =>$request->description,


        ];

        // insert data
        $this->points->create($data);

        // redirec to map
        return redirect()->route('map');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan 1 data tertentu
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //menampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //mirip store
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //remove/menghapus data dengan id tertentu
    }
}
