<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['id'];

    public function gejson_polylines()
    {
        $polylines = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, image,
            st_length(geom, true) as length_m, st_length(geom, true)/1000 as
            length_km, created_at, updated_at'))
            ->get();

            $geojson = [
                'type'=>'FeatureCollecion',
                'features'=>[]
            ];

            foreach ($polylines as $p){
                $feature = [
                    'type' => 'Feature',
                    'geometry' => json_decode($p->geom),
                    'properties' =>[
                        'id'=>$p->id,
                        'name' =>$p->name,
                        'description' =>$p->description,
                        'length_m' =>$p->length_m,
                        'length_km' =>$p->length_km,
                        'created_at' =>$p->created_at,
                        'updated_at' =>$p->updated_at,
                        'image'=> $p->image,
                    ],

                ];

                array_push($geojson['features'], $feature);
            }

        return $geojson;
    }

    public function gejson_polyline($id)
    {
        $polyline = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, image,
            st_length(geom, true) as length_m, st_length(geom, true)/1000 as
            length_km, created_at, updated_at'))
            ->where('id', $id)
            ->get();

            $geojson = [
                'type'=>'FeatureCollecion',
                'features'=>[]
            ];

            foreach ($polyline as $p){
                $feature = [
                    'type' => 'Feature',
                    'geometry' => json_decode($p->geom),
                    'properties' =>[
                        'id'=>$p->id,
                        'name' =>$p->name,
                        'description' =>$p->description,
                        'length_m' =>$p->length_m,
                        'length_km' =>$p->length_km,
                        'created_at' =>$p->created_at,
                        'updated_at' =>$p->updated_at,
                        'image'=> $p->image,
                    ],

                ];

                array_push($geojson['features'], $feature);
            }

        return $geojson;
    }
}
