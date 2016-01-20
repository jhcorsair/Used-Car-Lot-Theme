<?php

/**
 * @author James Haney
 * @copyright 1/2016
 */ 


function getCoordinates($address){
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
    $response = file_get_contents($url);
    $json = json_decode($response,true);
 
    $lat = $json['results'][0]['geometry']['location']['lat'];
    $lng = $json['results'][0]['geometry']['location']['lng'];
 
    return array($lat, $lng);
}
 
 
$coords = getCoordinates("ottsville, pennsylvania");
print_r($coords);


?>
<script type="text/javascript">

if (navigator.geolocation) {
  document.write("Hello World!");
}

</script>  