<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class poygonsModel extends Model
{
    protected $table = 'poygons';

    protected $guarded = ['id'];

    public function gejson_poygons()
    {
        $poygons = $this
            ->select(DB::raw('st_asgeojson(geom) as geom,
            COALESCE(st_area(geom, true), 0) as area_m2,
            COALESCE(st_area(geom, true)/1000000, 0) as area_km2,
            COALESCE(st_area(geom, true)/10000, 0) as area_hektar,
            name, description, created_at, updated_at'))
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($poygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_ha' => $p->area_ha,
                    'area_hektar' => $p->area_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ],

            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
