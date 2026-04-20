<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicineRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('category', 'like', "%{$request->search}%");
        }
        $medicines       = $query->orderBy('name')->paginate(15);
        $stokHampirHabis = Medicine::where('stock', '<', 10)->count();
        return view('apoteker.medicines.index', compact('medicines', 'stokHampirHabis'));
    }

    public function create()
    {
        return view('apoteker.medicines.create');
    }

    public function store(StoreMedicineRequest $request)
    {
        Medicine::create($request->validated());
        return redirect()->route('apoteker.medicines.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function show(Medicine $medicine)
    {
        return view('apoteker.medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('apoteker.medicines.edit', compact('medicine'));
    }

    public function update(StoreMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());
        return redirect()->route('apoteker.medicines.index')->with('success', 'Data obat diperbarui.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('apoteker.medicines.index')->with('success', 'Obat dihapus.');
    }

    public function restock(Request $request, Medicine $medicine)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);
        $medicine->increment('stock', $request->jumlah);
        return back()->with('success', "Stok {$medicine->name} berhasil ditambah {$request->jumlah} {$medicine->unit}.");
    }
}
