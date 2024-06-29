import{L as d}from"./index-HckQbaeO.js";var r={};const p={},o=new d({apiKey:r.GOOGLE_MAPS_API_KEY,version:"weekly",...p});o.load().then(async()=>{const{AdvancedMarkerElement:a,PinElement:g}=await google.maps.importLibrary("marker"),n=new google.maps.Map(document.getElementById("map"),{zoom:13,center:{lat:search.city.lat,lng:search.city.lng},mapId:"DEMO_MAP_ID"});for(const e of locations){const t=new a({map:n,content:l(e),position:{lat:Number(e.latitude),lng:Number(e.longitude)},title:e.title});t.addListener("click",()=>{i(t)})}function i(e,t){const s=e.content.querySelector("#price-tag");e.content.classList.contains("highlight")?(s.classList.remove("hide-tag"),e.content.classList.remove("highlight"),e.zIndex=null):(e.content.classList.add("highlight"),s.classList.add("hide-tag"),e.zIndex=1)}function l(e){const t=document.createElement("div");let s;return e.media[0].path?s=`<image class='min-w-[350px] w-full max-h-[200px]' src='${mainUrl}/listings/${e.media[0].path}'>`:s="<span class='text-gray-900 m-auto w-24 dark:text-gray-100'>No image</span>",t.classList.add("property"),t.innerHTML=`
        <div  class=" px-4 py-2 ">
        <div id="price-tag" class="price-tag">
                 ${(e==null?void 0:e.price_per_night)||"500,000"} <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>
            </div>
            <div  class="details bg-white hover:shadow-xl dark:hover:shadow-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div>
            
                ${s}
                <div class="-mt-44 mx-2 absolute hover:text-slate-300   ">
                
                    <svg  fill="#f1f1f1"  class="w-6 h-6  rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>


                </div>
                <div class="p-5 flex sm:flex-col justify-between align-baseline text-sm ">
                    
                    <a href="${mainUrl}/listing/${e.id}" class=" text-gray-900 dark:text-gray-100">
                        <span class="flex justify-between">
                        <p>
                        ${e.title}
                        </p>



                    <div class="flex gap-2 items-center">
                    <span>${e.rating} </span>
                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                       fill="currentColor" viewBox="0 0 22 20">
                       <path
                           d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                   </svg>
               </div>


                                     <span class="flex gap-1 border-2 p-1 rounded-md items-center">
                                        <p>
                                        ${(e==null?void 0:e.price_per_night)||""}
                                        </p>
                                    <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>
                                    </span>
                        </span>
                        <p>${e.address}</p>
           

                    </a>
                   
                    
                </div>
            </div>
            </div>
        </div>
      `,t}});
