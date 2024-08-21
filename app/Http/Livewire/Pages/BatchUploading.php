<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\FileArchive;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class BatchUploading extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $file, $type_id;
    public $batch_id;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|mimes:pdf|max:100000',
            'type_id' => ['required'],
        ]);
        $archive = new FileArchive;
        // $archive->file_name = $this->file->store('documents', 'dams');
        $archive->file_name = $this->file->store('public');
        $archive->title = $this->file->getClientOriginalName();
        $archive->file_ext = $this->file->getClientOriginalExtension();
        $archive->type_id = $this->type_id;
        $archive->type_secondary_id = $this->type_secondary_id ?? null;
        $archive->type_tertiary_id = $this->type_tertiary_id ?? null;
        $archive->type_tertiary_sub_id = $this->type_tertiary_sub_id ?? null;
        $archive->user_id = Auth::user()->id;
        $archive->batch_id = $this->batch_id;
        $archive->save();

        $this->alert('success', 'Saved!', [
            'toast' => true,
        ]);

        $this->resetExcept('type_id', 'batch_id');
    }

    public function render()
    {
        $archives = FileArchive::where('batch_id', $this->batch_id)->latest()->get();

        $type = Type::find($this->type_id);
        return view('livewire.pages.batch-uploading', [
            'type' => $type,
            'archives' => $archives,
        ]);
    }

    public function mount($type_id)
    {
        $this->type_id = $type_id;
        $this->batch_id = $this->incrementalHash();
    }

    function incrementalHash($len = 7){
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base){
          $i = $now % $base;
          $result = $charset[$i] . $result;
          $now /= $base;
        }
        return $this->type_id . substr($result, -5) . date('s');
      }
}
