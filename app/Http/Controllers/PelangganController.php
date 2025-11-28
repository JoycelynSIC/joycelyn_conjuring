<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['first_name', 'last_name', 'email', 'phone'];
        $filterableColumns = ['gender'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['first_name','last_name','birthday','gender','email','phone']);

        // Handle multiple file upload
        if ($request->hasFile('foto')) {
            $fotos = [];
            foreach ($request->file('foto') as $file) {
                $fotos[] = $file->store('pelanggan', 'public');
            }
            $data['fotos'] = $fotos;
        }

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource (Detail Pelanggan).
     */
    public function show(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        // Handle new multiple file upload
        if ($request->hasFile('foto')) {
            $existingFotos = $pelanggan->fotos ?? [];
            foreach ($request->file('foto') as $file) {
                $existingFotos[] = $file->store('pelanggan', 'public');
            }
            $pelanggan->fotos = $existingFotos;
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Hapus semua foto dari storage
        if ($pelanggan->fotos && count($pelanggan->fotos) > 0) {
            foreach ($pelanggan->fotos as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }

    public function deleteFile($id, $index)
{
    $pelanggan = Pelanggan::findOrFail($id);

    if(isset($pelanggan->fotos[$index])) {
        $file = $pelanggan->fotos[$index];

        // Hapus file dari storage
        if(Storage::disk('public')->exists($file)){
            Storage::disk('public')->delete($file);
        }

        // Hapus dari array fotos dan simpan
        $fotos = $pelanggan->fotos;
        array_splice($fotos, $index, 1);
        $pelanggan->fotos = $fotos;
        $pelanggan->save();
    }

    return redirect()->back()->with('success', 'File berhasil dihapus!');
}


}
