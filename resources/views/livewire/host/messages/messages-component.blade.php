<?php
use Livewire\Volt\Component;
use App\Models\Booking;
use App\Models\Messages;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;

new class extends Component
{
    use WithPagination;
    public $currentMessage=null;
    public $mail;
    public $users;

    public $allUsers=[];

    public string $content;

    public string $recipient_id;

    public function getMessages(){

        $myID =auth()->user()->id;

        $messagescontent=[];

        switch ($this->mail) {
                case 'Inbox':
                $messagescontent= Messages::where('recipient_id',$myID )->latest()->paginate(20);
                break;
                case 'sent':
                $messagescontent= Messages::where('sender_id', $myID)->latest()->paginate(20);
                break;
                case 'all':
                $messagescontent= Messages::where('sender_id', $myID)->orWhere('recipient_id', $myID)->latest()->paginate(20);
                break;
                case 'new':
                $allbooking = Booking::whereIn('listing_id', function ($query) use ($myID) {
                        $query->select('id')->from('listings')->where('host_id', $myID);
                    })->with('guest')->get();

                    $this->allUsers =  $allbooking->pluck('guest')->pluck('id')->toArray();
                $messagescontent = $allbooking->pluck('guest');

                break;


                break;
                default:
                $messagescontent= Messages::where('sender_id', $myID)->orWhere('recipient_id', $myID)->latest()->paginate(20);
                break;
        }

        return $messagescontent;

    }

    public function mount(Messages $Messages ){

        $this->mail = request()->mail ? request()->mail : null;

        if ( $Messages->id ) {

            $Messages->is_read = 1;

            $Messages->save();

            $this->currentMessage = $Messages;
        }


    }

    public function sendMessag():void{


        $messages= [
            'recipient_id.required' => 'The recipient field is required.',
            'content.required' => 'The content field is required.'
        ];

        $validated = $this->validate([
            'recipient_id' => ['required'],
            'content' => ['required'],
        ], $messages);

        if(!in_array($this->recipient_id, $this->allUsers)) {
            throw ValidationException::withMessages(['recipient_id' => 'Invalid recipient_id.']);
        }


        Messages::create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $this->recipient_id,
            'content' => $this->content,
            'is_read' => 0
        ]);

      //  $this->redirect('/messages', navigate: true)->with('OkToast', __('messages.message sent'));
       redirect()->route('Message')->with('OkToast', __('messages.message sent'));

    }

    public function deleteMessage($deleteMessageId){

        Messages::find($deleteMessageId)->delete();


       // $this->redirect('/messages', navigate: true)->with('OkToast', __('messages.message deleted'));
        redirect()->route('Message')->with('OkToast', __('messages.message deleted'));




    }

    public function with(): array
            {

            return [
                    'allmessages' => $this->getMessages() ,
                 ];

            }

    }


?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.messages') }}
    </h2>
</x-slot>


<div x-data="{deleteMessageId: 0}" class="py-12  flex gap-1 w-full ">

    <x-modal name="confirm-messages-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteMessage(deleteMessageId)" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('messages.Are you sure you want to delete this message?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('messages.Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('messages.Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <div class="w-1/6 mx-auto  sm:px-6 lg:px-8 space-y-6 ">
        <x-toast />
        <div class="p-2 sm:p-8  w-full bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class=" p-2 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-900  hover:bg-gray-200 sm:rounded-lg">
                <a href="{{ route('Message') }}?mail=new" class="text-sm py-2 text-md flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                      </svg>

                    انشاء رسالة
                </a>
            </div>

            <div  class=" p-2 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-900  hover:bg-gray-200 sm:rounded-lg">
                <a href="{{ route('Message') }}?mail=Inbox" class="text-sm py-2 text-md flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg>
                    صندوق الوارد
                </a>
            </div>

            <div  class=" p-2 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-900  hover:bg-gray-200 sm:rounded-lg">
                <a href="{{ route('Message') }}?mail=sent" class="text-sm py-2 text-md flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    المرسلة
                </a>
            </div>

            <div  class=" p-2 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-900  hover:bg-gray-200 sm:rounded-lg">
                <a href="{{ route('Message') }}?mail=all" class="text-sm py-2 text-md flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    جميع الرسائل
                </a>
            </div>
        </div>
    </div>

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 space-y-6 ">

        @if ($this->currentMessage )
        <div class=" p-4 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 shadow sm:rounded-lg">
            <p class="font-bold py-2 text-md flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                {{ $this->currentMessage->sender->id == auth()->user()->id ? "الى :". $this->currentMessage->recipient->name : $this->currentMessage->sender->name }}
                {{-- {{$this->currentMessage->sender->name}} --}}
            </p>
            <p class="font-bold  py-2 text-md  flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ $this->currentMessage->created_at->diffForHumans() }}
            </p>

            <p class="font-bold  py-2 text-lg">
                {{ $this->currentMessage->content }}
            </p>

        </div>
        @elseif ($mail=='new')
        <form wire:submit='sendMessag'  class=" p-4 w-full  bg-white dark:bg-gray-800 dark:text-gray-400 shadow sm:rounded-lg">




            <x-input-label for="user" value="المستخدميين" />

            <x-select-input  id="recipient_id" class="block mt-1 w-4/6" :options="$allmessages"

             wire:model.live='recipient_id'
             name="recipient_id" :value="old('recipient_id')" required
                autocomplete="recipient_id" />

            <x-input-error :messages="$errors->get('recipient_id')" class="mt-2" />

            <x-input-label for="content" value="الموضوع" />
            <x-text-area id="content" class="block mt-1 w-4/6" type="text" wire:model='content' name="content" :value="old('content')" required
                autocomplete="content" ></x-text-area>

            <x-input-error
            :messages="$errors->get('content')"
             class="mt-2" />
                <x-primary-button class="mt-4" type="submit">ارسال</x-primary-button>

        </form>


        @else
        <div class=" p-4 w-full  bg-white dark:bg-gray-800  shadow sm:rounded-lg">
            @foreach ($allmessages as $item)
            <div class="
                    @if ($item->is_read)
                    dark:bg-gray-900

                    bg-gray-200

                    @endif

                    rounded-md
                    flex px-4
                justify-between w-full gap-1
                dark:hover:bg-gray-950
                hover:bg-gray-200
                m-2 py-3 text-sm text-gray-500 dark:text-gray-400">
                <a class="flex w-3/4  justify-between  gap-2 " href="{{ route('Message', $item->id) }}">
                    <span class="text-gray-700 dark:text-gray-300">
                        {{ $item->sender->name }} </span>

                    <span>
                        {{ Str::limit($item->content, 100) }}

                    </span>

                    {{ $item->created_at->diffForHumans() }}

                </a>

                <button x-data=""
        x-on:click.prevent="deleteMessageId='{{ $item->id }}' ;$dispatch('open-modal', 'confirm-messages-deletion')" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
            <hr class="dark:border-gray-500  dark:border-gray-50">


            @endforeach

            <div class="mx-auto p-3" dir="ltr">
                {{ $allmessages->links() }}
            </div>
        </div>
        @endif



    </div>


</div>