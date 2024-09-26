<?php

namespace App\Http\Livewire\Reports;

use App\Models\FileArchive;
use App\Models\Tag;
use Carbon\Carbon;
use Livewire\Component;

class ArchivesReport extends Component
{
    public $start_date, $end_date, $tags = [];

    public $title, $archive_tags, $page_number;

    public function render()
    {

        $start_date = Carbon::parse($this->start_date)->startOfDay()->format('Y-m-d');
        $end_date = Carbon::parse($this->end_date)->endOfDay()->format('Y-m-d');

        $archives = FileArchive::query();

        if ($this->title) {
            $archives = $archives->where('title', 'LIKE', $this->title);
        }

        if ($this->archive_tags) {
            foreach ($this->archive_tags as $tag) {
                $archives = $archives->whereRaw("FIND_IN_SET('" . $tag . "', tags) > 0");
            }
        }

        $archives = $archives->whereBetween('updated_at', [$start_date, $end_date])->get();

        return view('livewire.reports.archives-report', compact(
            'archives',
        ));
    }

    public function mount($start_date = null, $end_date = null)
    {
        if ($start_date && $end_date) {
            $this->start_date = $start_date;
            $this->end_date = $end_date;
        } else {
            // $this->start_date = Carbon::parse(today());
            // $this->end_date = Carbon::parse(today());
        }

        if (isset($_GET['title'])) {
            $this->title = $_GET['title'];
        }

        if (isset($_GET['archive_tags'])) {
            $this->archive_tags = $_GET['archive_tags'];
        }

        if (isset($_GET['page_number'])) {
            $this->page_number = $_GET['page_number'];
        }

        $this->tags = Tag::all();
    }
}
