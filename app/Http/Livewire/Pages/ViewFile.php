<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Helper;
use App\Models\FileArchive;
use Livewire\Component;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ViewFile extends Component
{
    use WithFileUploads;

    protected $listeners = ['delete_archive'];

    public $archive_id, $size, $last_modified;

    public function render()
    {
        $archive = FileArchive::find($this->archive_id);
        $file_name = str_replace("public/", "", $archive->file_name);
        $file_name = str_replace("documents/", "", $file_name);

        $this->size = Helper::formatSizeUnits(Storage::disk('public')->size($file_name));
        $this->last_modified = Helper::format_date1(Storage::disk('public')->lastModified($file_name));

        return view('livewire.pages.view-file', compact(
            'archive',
            'file_name',
        ));
    }

    public function mount($archive_id)
    {
        $this->archive_id = $archive_id;
    }

    public function delete_archive()
    {
        FileArchive::find($this->archive_id)->delete();
        return $this->redirect(route('file.search'));
    }
}
