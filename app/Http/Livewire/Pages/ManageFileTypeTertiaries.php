<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\TypeSecondary;
use App\Models\TypeTertiary;
use Livewire\Component;

class ManageFileTypeTertiaries extends Component
{

    public $type_id;

    public function render()
    {
        $archives = FileArchive::where('type_secondary_id', $this->type_id)->whereNull('type_tertiary_sub_id')->get();
        $tags = Tag::all();
        $types = TypeTertiary::where('type_secondary_id', $this->type_id)->get();

        return view('livewire.pages.manage-file-type-tertiaries', compact(
            'types',
            'tags',
            'archives',
        ));
    }

    public function mount($type_id)
    {
        $this->type_id = $type_id;
    }
}
