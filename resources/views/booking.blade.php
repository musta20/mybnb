<x-layout.layout>
   <div class="flex w-5/6 gap-10 bg-slate-50 p-5 border rounded-lg mx-auto">
    <div class="w-1/2">
        <x-layout.check-date />
        <hr class="my-5">
          <img src="{{asset('listings/'.$listing->media[0]->path)}}" class="w-32 h-32 border rounded-lg" alt="">
          <span>
            {{$listing->title}}
          </span>
        </p>
        <hr class="my-5">
        <p>
            {{$start}} -- {{$end}}
        <hr class="my-5">
        </p>
        <x-layout.guest />
    </div>
    <div class="w-1/2">
        {{$listing->price_per_night}} <span class="text-xs" >{{__('messages.EGP')}}</span>    {{__('messages.per night')}}
        <hr class="my-5">
        <p>
            اجمالي السعر : 
        {{$price}} <span class="text-xs" >{{__('messages.EGP')}}</span> 
        </p>

    </div>
   </div>
</x-layout.layout>