import { Loader } from "@googlemaps/js-api-loader";

const additionalOptions = {};

const loader = new Loader({
    apiKey: process.env.GOOGLE_MAPS_API_KEY,
    version: "weekly",
    ...additionalOptions,
});
loader.load().then(async () => {

  let  Latitude = document.getElementById("Latitude");

  let  Longitude = document.getElementById("Longitude");
  let marker;


  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    const map = new google.maps.Map(document.getElementById("geoLoaction"), {

        zoom: 12,

        center: { lat: search.city.lat, lng: search.city.lng },

        mapId: "DEMO_MAP_ID",

    });
console.log(search)
    google.maps.event.addListenerOnce(map, 'idle', function(){
        if(Latitude.value && Longitude.value){

            marker = new AdvancedMarkerElement({
                
                position: { lat: Number(Latitude.value), lng: Number(Longitude.value) },
                map,
                title: "Re-Click to Delete",
    
            });
        }
        });
    map.addListener("click", (mapsMouseEvent) => {
   
        if (marker) marker.setMap(null);
        

        console.log(mapsMouseEvent.latLng.lat(),mapsMouseEvent.latLng.lng());


        Latitude.value=mapsMouseEvent.latLng.lat();

        Latitude.dispatchEvent(new Event('input'));

        Longitude.value=mapsMouseEvent.latLng.lng();
        
        Longitude.dispatchEvent(new Event('input'));

            marker = new AdvancedMarkerElement({
                position: mapsMouseEvent.latLng,
                map,
                title: "Re-Click to Delete",
            });


     
    });
});
