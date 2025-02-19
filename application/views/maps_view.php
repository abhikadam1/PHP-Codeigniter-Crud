<!DOCTYPE html>
<html>
<head>
    <title>Google Maps</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=your_api_key_here"></script>
    <script>
        function initMap() {
            var location = { lat: -34.397, lng: 150.644 }; // Example location
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
</head>
<body onload="initMap()">
    <h1>Google Maps Integration</h1>
    <div id="map" style="height: 500px; width: 100%;"></div>
</body>
</html>
