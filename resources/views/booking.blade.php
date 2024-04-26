<x-layout.layout>
   <form
   action="{{route('saveBooking', $listing->id)}}"
   method="POST"
   class="flex w-5/6 gap-10 bg-slate-50 p-5 border rounded-lg mx-auto">
   @csrf
    <div class="w-1/2">
        <x-layout.check-date :$start :$end />
        <hr class="my-5">
          <img src="{{asset('listings/'.$listing->media[0]->path)}}" class="w-32 h-32 border rounded-lg" alt="">
          <span>
            {{$listing->title}}
          </span>
        </p>
        <hr class="my-5">
        <p>
         from:   {{$start}} <br>
         to: {{$end}}
        <hr class="my-5">
        </p>
        <x-layout.guest :$beds />
    </div>
    <div class="w-1/2">
        {{$listing->price_per_night}} <span class="text-xs" >{{__('messages.EGP')}}</span>    {{__('messages.per night')}}
        <hr class="my-5">
        <p>
            اجمالي السعر : 
        {{$price}} <span class="text-xs" >{{__('messages.EGP')}}</span> 
        </p>
        <p>
          <button 
          class="bg-blue-500 m-5 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
          >حجز</button>
        </p>
    </div>
  </form>
</x-layout.layout>