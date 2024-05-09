<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\TypeSecondary;
use App\Models\TypeTertiarySub;
use Livewire\Component;

class ManageFileTypeTertiariesSub extends Component
{

    public $type_id;

    public function render()
    {
        $archives = FileArchive::where('type_tertiary_id', $this->type_id)->get();
        $tags = Tag::all();

        return view('livewire.pages.manage-file-type-tertiaries-sub', compact(
            'tags',
            'archives',
        ));
    }

    public function mount($type_id)
    {
        $this->type_id = $type_id;
    }
}
