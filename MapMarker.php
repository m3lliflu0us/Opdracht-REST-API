<?php

class MapMarker
{
    private $apiUrl = "https://nominatim.openstreetmap.org/search?format=json&q=Roermond";

    public function fetchCoordinates()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getCoordinates()
    {
        $data = $this->fetchCoordinates();
        if (!empty($data)) {
            return [
                'latitude' => $data['lat'],
                'longitude' => $data['lon']
            ];
        }
        return null;
    }
}

$mapMarker = new MapMarker();
$coordinates = $mapMarker->getCoordinates();

header('Content-Type: application/json');
echo json_encode($coordinates);