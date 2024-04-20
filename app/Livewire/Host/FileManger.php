<?php

namespace App\Livewire\Host;

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
            $imgename  = $imge->store(path:'listings');


            if ($this->listing) {


                $StoredImage =  ListingMedia::create(
                    [
                        'path' => $imgename,
                        'type' => MediaType::IMAGE->value,
                        'listing_id' => $this->listing->id,

                    ]
                );

                $this->subFiles[] = $StoredImage;
            } else {
                $this->dispatch('addImage', $imgename);
            }
        }
    }


    public function  remove($imageId)
    {

        if ($this->listing) {

            ListingMedia::where('id', $imageId)->first()->delete();
            //
            $this->subFiles = array_filter($this->subFiles, fn ($image) => $image['id'] != $imageId);
        } else {
            $this->dispatch('removeImage', $imageId);
        }
    }


    public function render()
    {
        return view('livewire.host.file-manger');
    }
}
