<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\Type;
use App\Models\TypeSecondary;
use App\Models\TypeTertiary;
use App\Models\TypeTertiarySub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = ['upload_done'];

    public $types = [], $types2 = [], $types3 = [], $types4 = [];
    public $search_type, $search_type2, $search_type3, $search_type4;
    public $title, $file, $file_name, $file_ext, $archive_tags = [];
    public $type_id, $type_secondary_id, $type_tertiary_id, $type_tertiary_sub_id;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|mimes:pdf|max:10000'
        ]);
    }

    public function updatedSearchType()
    {
        $this->types = Type::where('description', 'LIKE', '%' . $this->search_type . '%')
            ->orWhere('code', 'LIKE', '%' . $this->search_type . '%')
            ->get();

        if (isset($this->types[0])) {
            $this->type_id = $this->types[0]->id;
            $this->updatedTypeId();
        }
    }

    public function updatedSearchType2()
    {
        $this->types2 = TypeSecondary::where(function ($query) {
            $query->where('description', 'LIKE', '%' . $this->search_type2 . '%')
                ->orWhere('code', 'LIKE', '%' . $this->search_type2 . '%');
        })->where('type_id', $this->type_id)
            ->get();

        if (isset($this->types2[0])) {
            $this->type_secondary_id = $this->types2[0]->id;
            $this->updatedTypeSecondaryId();
        }
    }

    public function updatedSearchType3()
    {
        $this->types3 = TypeTertiary::where(function ($query) {
            $query->where('description', 'LIKE', '%' . $this->search_type3 . '%')
                ->orWhere('code', 'LIKE', '%' . $this->search_type3 . '%');
        })->where('type_secondary_id', $this->type_secondary_id)
            ->get();

        if (isset($this->types3[0])) {
            $this->type_tertiary_id = $this->types3[0]->id;
            $this->updatedTypeTertiaryId();
        }
    }

    public function updatedSearchType4()
    {
        $this->types4 = TypeTertiarySub::where(function ($query) {
            $query->where('description', 'LIKE', '%' . $this->search_type4 . '%')
                ->orWhere('code', 'LIKE', '%' . $this->search_type4 . '%');
        })->where('type_tertiary_id', $this->type_tertiary_id)
            ->get();

        if (isset($this->types4[0])) {
            $this->type_tertiary_sub_id = $this->types4[0]->id;
        }
    }

    public function updatedTypeId()
    {
        $this->types2 = TypeSecondary::where('type_id', $this->type_id)->get();
        $this->reset('types3', 'types4', 'type_secondary_id', 'type_tertiary_id');
    }

    public function updatedTypeSecondaryId()
    {
        $this->types3 = TypeTertiary::where('type_secondary_id', $this->type_secondary_id)->get();
        $this->reset('types4', 'type_tertiary_id');
    }

    public function updatedTypeTertiaryId()
    {
        $this->types4 = TypeTertiarySub::where('type_tertiary_id', $this->type_tertiary_id)->get();
    }


    public function render()
    {
        $tags = Tag::all();

        return view('livewire.pages.upload-file', compact(
            'tags',
        ));
    }

    public function mount()
    {
        $this->types = Type::all();
    }

    public function save()
    {
        $this->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'file' => 'required|mimes:pdf|max:100000',
            'type_id' => ['required'],
        ]);

        $archive = new FileArchive;
        $archive->file_name = $this->file->store('documents', 'dams');
        $archive->file_name = $this->file->store();
        $archive->title = $this->title ?? $this->file->getClientOriginalName();
        $archive->file_ext = $this->file->getClientOriginalExtension();
        $archive->tags = implode(',', $this->archive_tags);
        $archive->type_id = $this->type_id;
        $archive->type_secondary_id = $this->type_secondary_id ?? null;
        $archive->type_tertiary_id = $this->type_tertiary_id ?? null;
        $archive->type_tertiary_sub_id = $this->type_tertiary_sub_id ?? null;
        $archive->user_id = Auth::user()->id;
        $archive->save();

        foreach ($this->archive_tags as $tag) {
            $old_tag = Tag::where('description', $tag)->first();
            if (!$old_tag) {
                $new_tag = new Tag;
                $new_tag->description = $tag;
                $new_tag->save();
            }
        }

        $this->alert('success', 'Saved!', [
            'toast' => false,
            'timer' => false,
            'showDenyButton' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Add More',
            'denyButtonText' => 'Done',
            'position' => 'center',
            'onDenied' => 'upload_done'
        ]);

        $this->reset();
    }

    public function upload_done()
    {
        return $this->redirect(route('file.search'));
    }
}
