<?php


use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Enums\Status;
use Illuminate\Http\Request;
use App\Models\Booking as ModelsBooking;
use Carbon\Carbon;
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
  //  dd($this->numberOfDays);
        if($this->numberOfDays <= 0) return redirect()->route('host.listing',$this->listing)->with('ErorrToast',__("messages.Booking can not be done for the selected date"));




  }

public function saveBooking()
{

  $this->validate([
        'start' => 'required|date',
        'end' => 'required|date',
        'beds' => 'required|numeric|min:1',
    ]);


    $currentDate = Carbon::now();
    if($this->start < $currentDate || $this->end < $this->start){
        session()->flash('ErorrToast',__("messages.The check in date date must be greater than today's date and the check out date must be greater than the check in date"));
        return;
    }

    $hasBooking = $this->listing->bookings()->max('check_out_date');

    $parsedDate = Carbon::parse($hasBooking)->format('F j, Y');
    $parsedStartDate = Carbon::parse($this->start)->format('F j, Y');

    if ($parsedDate > $parsedStartDate ) {
      session()->flash('ErorrToast','messages.this listing is not avilble for booking at this date');

    }

    if(ModelsBooking::create([
        'listing_id' => $this->listing->id,
        'guest_id' => auth()->user()->id,
        'check_in_date' => $this->start,
        'check_out_date' => $this->end,
        'total_price' => $this->totalPrice,
        'status' => Status::PENDING->value
    ])){
      
      return redirect()->route('bookingdetail')->with('OkToast',__('messages.listing booked')); // session()->flash('okToast','تم اضافة الحجز بنجاح');
    }


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