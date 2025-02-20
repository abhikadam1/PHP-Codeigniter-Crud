<!DOCTYPE html>
<html>
<head>
    <title>Google Maps</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABsYtgCZmVcWIGmKVK0M88z9HMRmI6dgg"></script>
    <script>
        function initMap() {
            var location = { lat: 17.146482, lng: 74.482820 }; // Example location
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
