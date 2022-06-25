<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddSupplier extends Component
{
    public $companies;
    public $supplier_title;
    public $company_id;
    public $outlet_id;
    public $created_by;
    public $suppliers;



    protected $rules = [
        'supplier_title' => 'required|min:3',
        'company_id' => 'required',
        'outlet_id' => 'required',
        'created_by' => 'required',
    ];
  
    public function mount()
    {
        $this->companies = Company::where('outlet_id', session('outlet_id'))->pluck('company_title', 'id');
    }

    public function add_supplier()
    {
        $validatedData = $this->validate();
        // dd($getData['company_id']);

        $new_supplier = Supplier::create(
            [
                'supplier_title' => $validatedData['supplier_title'],
                'supplier_feature_img' => 'placeholder.jpg',
                'outlet_id' => $validatedData['outlet_id'],
                'created_by' => $validatedData['created_by']
            ]
        );

        $new_supplier->company()->sync($validatedData['company_id']);

        $this->dispatchBrowserEvent('hide-modal');

    }

    
    public function render()
    {
        $this->outlet_id = session('outlet_id');
        $this->created_by = Auth::user()->id;
        return view('livewire.add-supplier');
    }
}
