import { Loader } from "@googlemaps/js-api-loader";

const additionalOptions = {};

const loader = new Loader({
    apiKey: process.env.GOOGLE_MAPS_API_KEY,
    version: "weekly",
    ...additionalOptions,
});

loader.load().then(async () => {

    const { AdvancedMarkerElement, PinElement } =
        await google.maps.importLibrary("marker");

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: {lat:  search.city.lat , lng:  search.city.lng},
        mapId: "DEMO_MAP_ID", 
    });


    console.log(locations);
    for (const location of locations) {

        const AdvancedElement =
            new AdvancedMarkerElement({
                map,
                content: buildContent(location),
                position: { lat: location.latitude, lng: location.longitude },
                title: location.title,
            });

            AdvancedElement.addListener("click", () => {
            toggleHighlight(AdvancedElement, location);
        });
    }

    function toggleHighlight(markerView, property) {
        if (markerView.content.classList.contains("highlight")) {
            markerView.content.classList.remove("highlight");
            markerView.zIndex = null;
        } else {
            markerView.content.classList.add("highlight");
            markerView.zIndex = 1;
        }
    }

    function buildContent(location) {
        const content = document.createElement("div");


        content.classList.add("property");
        content.innerHTML = `
      <div class="price-tag">
      ${location?.price_per_night || "500,000"}
          
      </div>

      <div class="details">
          <div class="price">${location?.price_per_night || "500,000"}</div>
          <div class="address">${location?.address || "123 Main Street, New York, NY 10001"}</div>
          <div class="features">
          <div>
              <i aria-hidden="true" class="fa fa-bed fa-lg bed" title="bedroom"></i>
              <span class="fa-sr-only">bedroom</span>
              <span>${location?.number_of_bedrooms || "3"}</span>
          </div>
          <div>
              <i aria-hidden="true" class="fa fa-bath fa-lg bath" title="bathroom"></i>
              <span class="fa-sr-only">bathroom</span>
              <span>${location?.number_of_bathrooms || "2"}</span>
          </div>
          <div>
              <i aria-hidden="true" class="fa fa-ruler fa-lg size" title="size"></i>
              <span class="fa-sr-only">size</span>
              <span>${location?.number_of_guests || "2000"} ft<sup>2</sup></span>
          </div>
          </div>
      </div>
      `;
        return content;
    }

});

