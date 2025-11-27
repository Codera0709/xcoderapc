<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Requests\StoreSpouseRequest;
use App\Http\Requests\UpdateSpouseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpouseController extends Controller
{
    public function create($personId)
    {
        $person = Person::findOrFail($personId);
        return view('spouses.create', compact('person'));
    }

    public function store(StoreSpouseRequest $request, $personId)
    {
        $person = Person::findOrFail($personId);
        
        $validated = $request->validated();

        // Prepare spouse data by removing the 'spouse_' prefix
        $spouseData = [];
        foreach ($validated as $key => $value) {
            $spouseData[str_replace('spouse_', '', $key)] = $value;
        }
        
        // Set status_perkawinan to 'Kawin' for spouse
        $spouseData['status_perkawinan'] = 'Kawin';
        
        // Create the spouse
        $spouse = Person::create($spouseData);
        
        // Update the original person to link to the spouse
        $person->update(['spouse_id' => $spouse->id]);
        
        // Update the spouse to reference back to the person
        $spouse->update(['spouse_id' => $person->id]);

        return redirect()->route('presales.index')->with('success', 'Data spouse berhasil ditambahkan');
    }

    public function edit($personId)
    {
        $person = Person::with('spouse')->findOrFail($personId);
        if (!$person->spouse) {
            return redirect()->route('spouses.create', $personId)->with('error', 'Spouse data not found');
        }
        
        return view('spouses.edit', compact('person'));
    }

    public function update(UpdateSpouseRequest $request, $personId)
    {
        $person = Person::with('spouse')->findOrFail($personId);
        if (!$person->spouse) {
            return redirect()->route('spouses.create', $personId)->with('error', 'Spouse data not found');
        }
        
        $validated = $request->validated();

        // Prepare spouse data by removing the 'spouse_' prefix
        $spouseData = [];
        foreach ($validated as $key => $value) {
            $spouseData[str_replace('spouse_', '', $key)] = $value;
        }
        
        // Update the spouse
        $person->spouse->update($spouseData);

        return redirect()->route('presales.index')->with('success', 'Data spouse berhasil diperbarui');
    }
}