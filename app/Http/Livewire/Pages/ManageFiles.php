<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Tag;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class ManageFiles extends Component
{
    use WithPagination;

    public $title, $archive_tags, $page_number;

    public function render()
    {
        $archives = FileArchive::query();

        if ($this->title) {
            $archives = $archives->where('title', 'LIKE', $this->title);
        }

        if ($this->archive_tags) {
            foreach ($this->archive_tags as $tag) {
                $archives = $archives->whereRaw("FIND_IN_SET('" . $tag . "', tags) > 0");
            }
        }
        $archives = $archives->paginate($this->page_number);
        $tags = Tag::all();
        $types = Type::all();

        return view('livewire.pages.manage-files', compact(
            'types',
            'tags',
            'archives',
        ));
    }

    public function mount()
    {
        if (isset($_GET['title'])) {
            $this->title = $_GET['title'];
        }

        if (isset($_GET['archive_tags'])) {
            $this->archive_tags = $_GET['archive_tags'];
        }

        if (isset($_GET['page_number'])) {
            $this->page_number = $_GET['page_number'];
        }
    }
}
