<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Helper;
use App\Models\FileArchive;
use Livewire\Component;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ViewFile extends Component
{

    public $archive_id, $size, $last_modified;

    public function render()
    {
        $archive = FileArchive::find($this->archive_id);
        $this->size = Helper::formatSizeUnits(Storage::disk('dams')->size($archive->file_name));
        $this->last_modified = Helper::format_date1(Storage::disk('dams')->lastModified($archive->file_name));

        return view('livewire.pages.view-file', compact(
            'archive'
        ));
    }

    public function mount($archive_id)
    {
        $this->archive_id = $archive_id;
    }
}
