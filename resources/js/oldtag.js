<div id="price-tag" class="price-tag">
                 ${
                     location?.price_per_night || "500,000"
                 } <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>
            </div>

      <div class="details ">
          <div class="price">${location?.price_per_night || "500,000"}</div>
          <div class="address">${
              location?.address || "123 Main Street, New York, NY 10001"
          }</div>
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
              <span>${
                  location?.number_of_guests || "2000"
              } ft<sup>2</sup></span>
          </div>
          </div>
      </div>