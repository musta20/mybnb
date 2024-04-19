<?php

namespace App\Livewire\Admin;

use App\Enums\MediaType;
use App\Models\ListingMedia;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileManger extends Component
{

    use WithFileUploads;

    #[Validate(['photo.*' => 'image|max:1024'])]
    public $photo;
    
    #[Modelable] 
    public $subFiles;

    public $listing;

    public function updatedPhoto()
    {
        foreach ($this->photo as $imge) {
            $imgename  = $imge->store();


            if ($this->product) {
                $this->subFiles[$imgename] = MediaType::IMAGE->value;

                ListingMedia::create(
                    [
                        'name' => $imgename,
                        'type' => MediaType::IMAGE->value,
                        'product_id' => $this->product->id,
                    ]
                );
            }else
            {
                $this->dispatch('addImage',$imgename);

            }
        }
    }


    public function  remove($imageName)
    {

        if ($this->listing) {
            ListingMedia::where('name', $imageName)->first()->delete();

            $this->subFiles = array_filter($this->subFiles, fn ($type, $name) => $name != $imageName, ARRAY_FILTER_USE_BOTH);

        }else{
            $this->dispatch('removeImage',$imageName);

        }

    }


    public function render()
    {
        return view('livewire.host.file-manger');
    }
}
