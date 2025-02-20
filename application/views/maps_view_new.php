<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Map in CI3</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKey; ?>"></script>
    <script>
        function initMap() {
            var location = { lat: <?= $latitude; ?>, lng: <?= $longitude; ?> };
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
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
    <h2>Google Map in CodeIgniter 3</h2>
    <div id="map" style="height: 400px; width: 100%;"></div>
</body>
</html>
