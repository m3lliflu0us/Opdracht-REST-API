<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Marker</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([51.1942, 5.9878], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([51.1942, 5.9878]).addTo(map);

        fetch('MapMarker.php')
            .then(response => response.json())
            .then(data => {
                if (data.latitude && data.longitude) {
                    var lat = data.latitude;
                    var lon = data.longitude;
                    map.setView([lat, lon], 13);
                    marker.setLatLng([lat, lon]);
                }
            });
    </script>
</body>

</html>