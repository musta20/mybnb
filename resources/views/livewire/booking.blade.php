<?php


use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Enums\Status;
use Illuminate\Http\Request;
use App\Models\Booking as ModelsBooking;

use Livewire\Attributes\{Layout, Title};

new
#[layout('components.layout.layout')]
class extends Component
{

  public $listing;
  public $price;
  public $start;
  public $end;
  public $beds;
  public $totalPrice;
  public $numberOfDays;

  public function addBeds()
  {
    $this->beds = $this->beds + 1;
  }

  public function removeBeds()
  {
    $this->beds = $this->beds > 0 ? $this->beds - 1 : 0;
  }

  public function getDays()
  {
    $startDate = \Carbon\Carbon::parse($this->start);
    $endDate = \Carbon\Carbon::parse($this->end);
    $this->numberOfDays = $startDate->diffInDays($endDate) + 1;
    $this->totalPrice = $this->listing->price_per_night * $this->numberOfDays;

  }

  public function updated($start, $end){
    
    $this->getDays();
  }


  public function mount(Listing $listing,Request $request)
  {

    $this->listing = $listing;

    if ($listing->status != Status::PUBLISHED->value) return     abort(404);

          $this->beds = $request->bedrooms;
          $this->start = $request->start;
          $this->end = $request->end; 
          // $startDate = \Carbon\Carbon::parse($this->start);
          // $endDate = \Carbon\Carbon::parse($this->end);
          // $this->numberOfDays = $startDate->diffInDays($endDate) + 1;

          $this->getDays();

  }

public function saveBooking()
{

  $this->validate([
        'start' => 'required|date',
        'end' => 'required|date',
        'beds' => 'required|numeric|min:1',
    ]);


    $currentDate = \Carbon\Carbon::now();
    if($this->start < $currentDate || $this->end < $this->start){
        session()->flash('ErorrToast','يجب ان يكون التاريخ البداية اكبر من تاريخ اليوم و يكون تاريخ النهاية اكبر من تاريخ البداية');
        return;
    }

    if(ModelsBooking::create([
        'listing_id' => $this->listing->id,
        'guest_id' => auth()->user()->id,
        'check_in_date' => $this->start,
        'check_out_date' => $this->end,
        'total_price' => $this->totalPrice,
        'status' => Status::PENDING->value
    ])){
      
      return redirect()->route('bookingdetail')->with('OkToast','تم الحجز بنجاح'); // session()->flash('okToast','تم اضافة الحجز بنجاح');
    }

    // ModelsBooking::create([
    //     'listing_id' => $listing->id,
    //     'guest_id' => auth()->user()->id,
    //     'check_in_date' => $request->start,
    //     'check_out_date' => $request->end,
    //     'total_price' => $listing->price_per_night * $request->beds

    // ]); 
}

}


?>

<form wire:submit.prevent="saveBooking" method="POST"
  class="flex w-5/6 gap-10 bg-slate-50 p-5 border dark:bg-slate-700 dark:border-slate-500  rounded-lg mx-auto">
  @csrf
  <x-toast />

  <div class="w-1/2">

    <x-layout.booking-check-date />
    <hr class="my-5 dark:border-slate-500 ">
    <img src="{{asset('listings/'.$listing->media[0]->path)}}" class="w-32 h-32 border rounded-lg" alt="">
    <span>
      {{$listing->title}}
    </span>
    </p>
    <hr class="my-5 dark:border-slate-500 ">

    <p>
      الضيوف : {{$beds}}
      <br>
      النزول: {{$start}}
      <br>
      المغادرة: {{$end}}
      <hr class="my-5 dark:border-slate-500 ">
    </p>
    {{$listing->price_per_night}} <span class="text-xs">{{__('messages.EGP')}}</span> {{__('messages.per night')}}

    <x-layout.booking-guest :$beds />

  </div>
  <div class="w-1/2">
    <p>
      الايام : {{floor($numberOfDays)}}
    </p>
    <hr class="my-5 dark:border-slate-500 ">
    <p>
      {{floor($numberOfDays)}} * {{$listing->price_per_night}}
    </p>
    <hr class="my-5 dark:border-slate-500 ">

    <p>
      اجمالي السعر :
      {{ floor($totalPrice) }} <span class="text-xs">{{__('messages.EGP')}}</span>
    </p>
    <p>
      <button class="bg-blue-500 m-5 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">تأكيد الحجز</button>
    </p>
  </div>
</form>