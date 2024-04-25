<div class="flex justify-between w-2/3 gap-1 py-4">
    <span>
        ضع تقييما:
    </span>
        <div class="flex" x-data="{rating:'',clicked: new Array(5).fill(false)}">
            <svg @click="clicked.fill(false).fill(true, 0, 5);rating=5" :class="{ 'text-yellow-300' : clicked[4]}"
                class="w-4 h-4 text-gray-200 peer hover:cursor-pointer peer-hover:text-yellow-300 hover:text-yellow-300   mx-2"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
            </svg>

            <svg @click="clicked.fill(false).fill(true, 0, 4);rating=4" :class="{ 'text-yellow-300' : clicked[3]}"
                class="w-4 h-4 text-gray-200 peer hover:cursor-pointer peer-hover:text-yellow-300 hover:text-yellow-300   mx-2"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
            </svg>

            <svg @click="clicked.fill(false).fill(true, 0, 3);rating=3" :class="{ 'text-yellow-300' : clicked[2]}"
                class="w-4 h-4 text-gray-200 peer hover:cursor-pointer peer-hover:text-yellow-300 hover:text-yellow-300   mx-2"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
            </svg>

            <svg @click="clicked.fill(false).fill(true, 0, 2);rating=2" :class="{ 'text-yellow-300' : clicked[1]}"
                class="w-4 h-4 text-gray-200 peer hover:cursor-pointer peer-hover:text-yellow-300 hover:text-yellow-300   mx-2"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
            </svg>

            <svg @click="clicked.fill(false).fill(true, 0, 1);rating=1" :class="{ 'text-yellow-300' : clicked[0]}"
                class="w-4 h-4 text-gray-200 peer hover:cursor-pointer peer-hover:!text-yellow-300 hover:text-yellow-300   mx-2"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path
                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
            </svg>
            <input class="hidden" name="rating" :value="rating">

        </div>



</div>