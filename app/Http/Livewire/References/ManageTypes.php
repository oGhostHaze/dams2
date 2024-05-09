<?php

namespace App\Http\Livewire\References;

use App\Models\Type;
use App\Models\TypeSecondary;
use App\Models\TypeTertiary;
use App\Models\TypeTertiarySub;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManageTypes extends Component
{
    use LivewireAlert;

    protected $listeners = ['save_type', 'save_type2', 'save_type3', 'save_type4', 'update', 'update2', 'update3', 'update4'];

    public $type_desc, $type_code;

    public function render()
    {
        $types = Type::withTrashed()->orderBy('code', 'ASC')->get();

        return view('livewire.references.types.manage-types', compact(
            'types',
        ));
    }

    public function save_type()
    {
        $this->validate([
            'type_code' => ['required', 'string', 'max:255', 'unique:types,code'],
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = new Type;
        $type->code =  (string) strtoupper($this->type_code);
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Saved!');
    }

    public function save_type2($type_id, $code)
    {
        $this->validate([
            'type_code' => ['required', 'string', 'max:255', 'unique:type_secondaries,code'],
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = new TypeSecondary();
        $type->type_id = $type_id;
        $type->code = $code . ((string) strtoupper($this->type_code));
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Saved!');
    }

    public function save_type3($type_id, $code)
    {
        $this->validate([
            'type_code' => ['required', 'string', 'max:255', 'unique:type_tertiaries,code'],
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = new TypeTertiary();
        $type->type_secondary_id = $type_id;
        $type->code = $code . ((string) strtoupper($this->type_code));
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Saved!');
    }

    public function save_type4($type_id, $code)
    {
        $this->validate([
            'type_code' => ['required', 'string', 'max:255', 'unique:type_tertiary_subs,code'],
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = new TypeTertiarySub();
        $type->type_tertiary_id = $type_id;
        $type->code = $code . ((string) strtoupper($this->type_code));
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Saved!');
    }

    public function update($type_id)
    {
        $this->validate([
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = Type::where('id', $type_id)->first();
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Updated!');
    }

    public function update2($type_id)
    {
        $this->validate([
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = TypeSecondary::where('id', $type_id)->first();
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Updated!');
    }

    public function update3($type_id)
    {
        $this->validate([
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = TypeTertiary::where('id', $type_id)->first();
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Updated!');
    }

    public function update4($type_id)
    {
        $this->validate([
            'type_desc' => ['required', 'string', 'max:255'],
        ]);

        $type = TypeTertiarySub::where('id', $type_id)->first();
        $type->description = (string) strtoupper($this->type_desc);
        $type->save();

        $this->reset();

        return $this->alert('success', 'Updated!');
    }
}
