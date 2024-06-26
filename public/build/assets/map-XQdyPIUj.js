function S(n,e,i,s){function a(t){return t instanceof i?t:new i(function(r){r(t)})}return new(i||(i=Promise))(function(t,r){function o(l){try{h(s.next(l))}catch(c){r(c)}}function d(l){try{h(s.throw(l))}catch(c){r(c)}}function h(l){l.done?t(l.value):a(l.value).then(o,d)}h((s=s.apply(n,e||[])).next())})}function L(n){return n&&n.__esModule&&Object.prototype.hasOwnProperty.call(n,"default")?n.default:n}var O=function n(e,i){if(e===i)return!0;if(e&&i&&typeof e=="object"&&typeof i=="object"){if(e.constructor!==i.constructor)return!1;var s,a,t;if(Array.isArray(e)){if(s=e.length,s!=i.length)return!1;for(a=s;a--!==0;)if(!n(e[a],i[a]))return!1;return!0}if(e.constructor===RegExp)return e.source===i.source&&e.flags===i.flags;if(e.valueOf!==Object.prototype.valueOf)return e.valueOf()===i.valueOf();if(e.toString!==Object.prototype.toString)return e.toString()===i.toString();if(t=Object.keys(e),s=t.length,s!==Object.keys(i).length)return!1;for(a=s;a--!==0;)if(!Object.prototype.hasOwnProperty.call(i,t[a]))return!1;for(a=s;a--!==0;){var r=t[a];if(!n(e[r],i[r]))return!1}return!0}return e!==e&&i!==i},A=L(O);const x="__googleMapsScriptId";var g;(function(n){n[n.INITIALIZED=0]="INITIALIZED",n[n.LOADING=1]="LOADING",n[n.SUCCESS=2]="SUCCESS",n[n.FAILURE=3]="FAILURE"})(g||(g={}));class p{constructor({apiKey:e,authReferrerPolicy:i,channel:s,client:a,id:t=x,language:r,libraries:o=[],mapIds:d,nonce:h,region:l,retries:c=3,url:m="https://maps.googleapis.com/maps/api/js",version:u}){if(this.callbacks=[],this.done=!1,this.loading=!1,this.errors=[],this.apiKey=e,this.authReferrerPolicy=i,this.channel=s,this.client=a,this.id=t||x,this.language=r,this.libraries=o,this.mapIds=d,this.nonce=h,this.region=l,this.retries=c,this.url=m,this.version=u,p.instance){if(!A(this.options,p.instance.options))throw new Error(`Loader must not be called again with different options. ${JSON.stringify(this.options)} !== ${JSON.stringify(p.instance.options)}`);return p.instance}p.instance=this}get options(){return{version:this.version,apiKey:this.apiKey,channel:this.channel,client:this.client,id:this.id,libraries:this.libraries,language:this.language,region:this.region,mapIds:this.mapIds,nonce:this.nonce,url:this.url,authReferrerPolicy:this.authReferrerPolicy}}get status(){return this.errors.length?g.FAILURE:this.done?g.SUCCESS:this.loading?g.LOADING:g.INITIALIZED}get failed(){return this.done&&!this.loading&&this.errors.length>=this.retries+1}createUrl(){let e=this.url;return e+="?callback=__googleMapsCallback&loading=async",this.apiKey&&(e+=`&key=${this.apiKey}`),this.channel&&(e+=`&channel=${this.channel}`),this.client&&(e+=`&client=${this.client}`),this.libraries.length>0&&(e+=`&libraries=${this.libraries.join(",")}`),this.language&&(e+=`&language=${this.language}`),this.region&&(e+=`&region=${this.region}`),this.version&&(e+=`&v=${this.version}`),this.mapIds&&(e+=`&map_ids=${this.mapIds.join(",")}`),this.authReferrerPolicy&&(e+=`&auth_referrer_policy=${this.authReferrerPolicy}`),e}deleteScript(){const e=document.getElementById(this.id);e&&e.remove()}load(){return this.loadPromise()}loadPromise(){return new Promise((e,i)=>{this.loadCallback(s=>{s?i(s.error):e(window.google)})})}importLibrary(e){return this.execute(),google.maps.importLibrary(e)}loadCallback(e){this.callbacks.push(e),this.execute()}setScript(){var e,i;if(document.getElementById(this.id)){this.callback();return}const s={key:this.apiKey,channel:this.channel,client:this.client,libraries:this.libraries.length&&this.libraries,v:this.version,mapIds:this.mapIds,language:this.language,region:this.region,authReferrerPolicy:this.authReferrerPolicy};Object.keys(s).forEach(t=>!s[t]&&delete s[t]),!((i=(e=window==null?void 0:window.google)===null||e===void 0?void 0:e.maps)===null||i===void 0)&&i.importLibrary||(t=>{let r,o,d,h="The Google Maps JavaScript API",l="google",c="importLibrary",m="__ib__",u=document,f=window;f=f[l]||(f[l]={});const v=f.maps||(f.maps={}),I=new Set,y=new URLSearchParams,_=()=>r||(r=new Promise((w,b)=>S(this,void 0,void 0,function*(){var E;yield o=u.createElement("script"),o.id=this.id,y.set("libraries",[...I]+"");for(d in t)y.set(d.replace(/[A-Z]/g,k=>"_"+k[0].toLowerCase()),t[d]);y.set("callback",l+".maps."+m),o.src=this.url+"?"+y,v[m]=w,o.onerror=()=>r=b(Error(h+" could not load.")),o.nonce=this.nonce||((E=u.querySelector("script[nonce]"))===null||E===void 0?void 0:E.nonce)||"",u.head.append(o)})));v[c]?console.warn(h+" only loads once. Ignoring:",t):v[c]=(w,...b)=>I.add(w)&&_().then(()=>v[c](w,...b))})(s);const a=this.libraries.map(t=>this.importLibrary(t));a.length||a.push(this.importLibrary("core")),Promise.all(a).then(()=>this.callback(),t=>{const r=new ErrorEvent("error",{error:t});this.loadErrorCallback(r)})}reset(){this.deleteScript(),this.done=!1,this.loading=!1,this.errors=[],this.onerrorEvent=null}resetIfRetryingFailed(){this.failed&&this.reset()}loadErrorCallback(e){if(this.errors.push(e),this.errors.length<=this.retries){const i=this.errors.length*Math.pow(2,this.errors.length);console.error(`Failed to load Google Maps script, retrying in ${i} ms.`),setTimeout(()=>{this.deleteScript(),this.setScript()},i)}else this.onerrorEvent=e,this.callback()}callback(){this.done=!0,this.loading=!1,this.callbacks.forEach(e=>{e(this.onerrorEvent)}),this.callbacks=[]}execute(){if(this.resetIfRetryingFailed(),this.done)this.callback();else{if(window.google&&window.google.maps&&window.google.maps.version){console.warn("Google Maps already loaded outside @googlemaps/js-api-loader.This may result in undesirable behavior as options and script parameters may not match."),this.callback();return}this.loading||(this.loading=!0,this.setScript())}}}var P={};const $={},j=new p({apiKey:P.GOOGLE_MAPS_API_KEY,version:"weekly",...$});j.load().then(async()=>{const{AdvancedMarkerElement:n,PinElement:e}=await google.maps.importLibrary("marker"),i=new google.maps.Map(document.getElementById("map"),{zoom:13,center:{lat:search.city.lat,lng:search.city.lng},mapId:"DEMO_MAP_ID"});for(const t of locations){const r=new n({map:i,content:a(t),position:{lat:Number(t.latitude),lng:Number(t.longitude)},title:t.title});r.addListener("click",()=>{s(r)})}function s(t,r){const o=t.content.querySelector("#price-tag");t.content.classList.contains("highlight")?(o.classList.remove("hide-tag"),t.content.classList.remove("highlight"),t.zIndex=null):(t.content.classList.add("highlight"),o.classList.add("hide-tag"),t.zIndex=1)}function a(t){const r=document.createElement("div");let o;return t.media[0].path?o=`<image class='min-w-[350px] w-full max-h-[200px]' src='http://localhost/listings/${t.media[0].path}'>`:o="<span class='text-gray-900 m-auto w-24 dark:text-gray-100'>No image</span>",r.classList.add("property"),r.innerHTML=`
        <div  class=" px-4 py-2 ">
        <div id="price-tag" class="price-tag">
                 ${(t==null?void 0:t.price_per_night)||"500,000"} <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>
            </div>
            <div  class="details bg-white hover:shadow-xl dark:hover:shadow-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div>
            
                ${o}
                <div class="-mt-44 mx-2 absolute hover:text-slate-300   ">
                
                    <svg  fill="#f1f1f1"  class="w-6 h-6  rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>


                </div>
                <div class="p-5 flex sm:flex-col justify-between align-baseline text-sm ">
                    
                    <a href="http://localhost/listing/${t.id}" class=" text-gray-900 dark:text-gray-100">
                        <span class="flex justify-between">
                        <p>
                        ${t.title}
                        </p>



                    <div class="flex gap-2 items-center">
                    <span>${t.rating} </span>
                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                       fill="currentColor" viewBox="0 0 22 20">
                       <path
                           d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                   </svg>
               </div>


                                     <span class="flex gap-1 border-2 p-1 rounded-md items-center">
                                        <p>
                                        ${(t==null?void 0:t.price_per_night)||""}
                                        </p>
                                    <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>
                                    </span>
                        </span>
                        <p>${t.address}</p>
           

                    </a>
                   
                    
                </div>
            </div>
            </div>
        </div>
      `,r}});
