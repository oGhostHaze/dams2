<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFileSecondary extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = ['upload_done'];

    public $title, $file, $file_name, $file_ext, $archive_tags = [];
    public $type_id, $type;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|mimes:pdf|max:100000'
        ]);
    }

    public function render()
    {
        $tags = Tag::all();

        return view('livewire.pages.upload-file-secondary', compact(
            'tags',
        ));
    }

    public function mount($type_id)
    {
        $this->type_id = $type_id;
        $this->type = Type::find($type_id);
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

        $this->resetExcept('type_id', 'type');
    }

    public function upload_done()
    {
        return $this->redirect(route('file.search'));
    }
}
