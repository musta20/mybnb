import{L as o}from"./index-HckQbaeO.js";var d={};const c={},g=new o({apiKey:d.GOOGLE_MAPS_API_KEY,version:"weekly",...c});g.load().then(async()=>{let t=document.getElementById("Latitude"),n=document.getElementById("Longitude"),l;const{AdvancedMarkerElement:i}=await google.maps.importLibrary("marker"),a=new google.maps.Map(document.getElementById("geoLoaction"),{zoom:12,center:{lat:search.city.lat,lng:search.city.lng},mapId:"DEMO_MAP_ID"});google.maps.event.addListenerOnce(a,"idle",function(){t.value&&n.value&&(l=new i({position:{lat:Number(t.value),lng:Number(n.value)},map:a,title:"Re-Click to Delete"}))}),a.addListener("click",e=>{l&&l.setMap(null),console.log(e.latLng.lat(),e.latLng.lng()),t.value=e.latLng.lat(),t.dispatchEvent(new Event("input")),n.value=e.latLng.lng(),n.dispatchEvent(new Event("input")),l=new i({position:e.latLng,map:a,title:"Re-Click to Delete"})})});
