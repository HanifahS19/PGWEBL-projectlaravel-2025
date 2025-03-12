@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">


    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
            /* kenapa 56 (tinggi dari navbarnya) */
        }
    </style>
@endsection

</head>

<body>

    @section('content')
        <div id="map"></div>

        <!-- Modal -->
        <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('points.store')}}">
                    <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill point name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>


                            <div class="mb-3">
                                <label for="geom_point" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://unpkg.com/@terraformer/wkt"></script>


        <script>
            var map = L.map('map').setView([-7.796955750440548, 110.37450039580591], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);



            /* Digitize Function */
            var drawnItems = new L
                .FeatureGroup(); //membuat sebuagh fitur grup untuk var yang maana yang featuru. wadah menampung objek yang digambarkan
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({ // memunculkan tools untuk menggambar
                draw: {
                    position: 'topleft',
                    polyline: true, // ditampilkan
                    polygon: true,
                    rectangle: true,
                    circle: false, //tiadak ditampilkan
                    marker: true,
                    circlemarker: false
                },
                edit: false
            });

            map.addControl(drawControl);

            map.on('draw:created', function(e) {
                var type = e.layerType,
                    layer = e.layer;

                console.log(type); // marker

                var drawnJSONObject = layer.toGeoJSON();
                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

                console.log(drawnJSONObject); // ada 2
                //	console.log(objectGeometry);

                if (type === 'polyline') { // condition misal type polyline akan memunculkan
                    console.log("Create " + type);


                    // Nneti memunculkan modal create polyline
                } else if (type === 'polygon' || type === 'rectangle') {
                    console.log("Create " + type); // munculnya poligon



                } else if (type === 'marker') {
                    console.log("Create " + type);

                    $('#geom_point').val(objectGeometry);

                    //Nneti memunculkan modal create marker
                    $('#createpointModal').modal('show');

                } else {
                    console.log('__undefined__');
                }

                drawnItems.addLayer(layer);
            });
        </script>
    @endsection
