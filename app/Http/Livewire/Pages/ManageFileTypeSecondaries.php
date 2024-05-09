<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\TypeSecondary;
use Livewire\Component;

class ManageFileTypeSecondaries extends Component
{

    public $type_id;

    public function render()
    {
        $archives = FileArchive::where('type_id', $this->type_id)->whereNull('type_tertiary_id')->get();
        $tags = Tag::all();
        $types = TypeSecondary::where('type_id', $this->type_id)->get();

        return view('livewire.pages.manage-file-type-secondaries', compact(
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
