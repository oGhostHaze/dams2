<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\Type;
use App\Models\TypeSecondary;
use Livewire\Component;
use Livewire\WithPagination;

class ManageFileTypes extends Component
{
    use WithPagination;

    public function render()
    {
        $types = Type::all();
        $tags = Tag::all();

        return view('livewire.pages.manage-file-types', compact(
            'types',
            'tags',
        ));
    }
}
