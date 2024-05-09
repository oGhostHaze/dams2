<?php

namespace App\Http\Livewire\Pages;

use App\Models\FileArchive;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $archives_total = FileArchive::count();
        $types = Type::all();

        return view('livewire.pages.dashboard', compact(
            'archives_total',
            'types',
        ));
    }
}