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

        <!-- Modal creaete point -->
        <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
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

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_point" name="image"
                                    onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                    width="400" height="250">
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


        <!-- Modal creaete Polylines -->
        <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
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
                                <label for="geom_polyline" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_polylines" name="image"
                                    onchange="document.getElementById('preview-image-polylines').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-polylines" class="img-thumbnail"
                                    width="400">
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


        <!-- Modal creaete Polygon -->
        <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('poygons.store') }}" enctype="multipart/form-data">
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
                                <label for="geom_polygon" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_poygons" name="image"
                                    onchange="document.getElementById('preview-image-poygons').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-poygons" class="img-thumbnail"
                                    width="400">
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

                    $('#geom_polyline').val(objectGeometry);

                    //Nneti memunculkan modal create marker
                    $('#createpolylineModal').modal('show');

                } else if (type === 'polygon' || type === 'rectangle') {
                    console.log("Create " + type); // munculnya poligon


                    $('#geom_polygon').val(objectGeometry);

                    //Nneti memunculkan modal create marker
                    $('#createpolygonModal').modal('show');



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

            // geojson points pop up konten
            var point = L.geoJson(null, {
                onEachFeature: function(feature, layer) {

                    var routedelete = "{{ route('points.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('points.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);

                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Dibuat:" + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='250' alt=''>" + "<br>" +

                        "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +

                        "<a href='" + routeedit +
                        "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +

                        "</div>" +
                        "<div class='col-6'>" +

                        "<form method='POST' action=' " + routedelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                        "</form>" +

                        "</div>" +
                        "</div>" + "<br>" +
                        "<p>Dibuat oleh: " + feature.properties.user_created + "</p>";


                    layer.on({
                        click: function(e) {
                            point.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            point.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.points') }}", function(data) {
                point.addData(data);
                map.addLayer(point);
            });


            // geojson polylines
            var polyline = L.geoJson(null, {
                onEachFeature: function(feature, layer) {


                    var routedelete = "{{ route('polylines.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('polylines.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);

                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Panjang: " + feature.properties.length_km.toFixed() + "<br>" +
                        "Dibuat:" + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='250' alt=''>" + "<br>" +

                        "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +

                        "<a href='" + routeedit +
                        "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +

                        "</div>" +
                        "<div class='col-6'>" +

                        "<form method='POST' action=' " + routedelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
"</form>" +


                        "</div>" +
                        "</div>" + "<br>" +
                        "<p>Dibuat oleh: " + feature.properties.user_created + "</p>";


                    layer.on({
                        click: function(e) {
                            polyline.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            polyline.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.polylines') }}", function(data) {
                polyline.addData(data);
                map.addLayer(polyline);
            });


            // geojson polylines
            var poygons = L.geoJson(null, {
                onEachFeature: function(feature, layer) {

                    var routedelete = "{{ route('poygons.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('poygons.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);


                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Luas: " + feature.properties.area_m2.toFixed(2) + "<br>" +
                        "Dibuat:" + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='250' alt=' '>" + "<br>" +

                        "<div class='row mt-4'>" +
                        "<div class='col-6 text-end'>" +

                        "<a href='" + routeedit +
                        " ' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +

                        "</div>" +
                        "<div class='col-6'>" +

                        "<form method='POST' action=' " + routedelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>" + "<br>" +
                        "<p>Dibuat oleh: " + feature.properties.user_created + "</p>";


                    layer.on({
                        click: function(e) {
                            poygons.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            poygons.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.poygons') }}", function(data) {
                poygons.addData(data);
                map.addLayer(poygons);
            });
        </script>
    @endsection
