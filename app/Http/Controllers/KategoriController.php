<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:png,jpeg,jpg|max:2048'
        ])->validate();

        $filePath = public_path('uploads');
        $insert = new Kategori();
        $insert->name = $request->name;
        $insert->description = $request->description;
        $insert->photo = $request->photo;

        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();

            $file->move($filePath, $file_name);
            $insert->photo = $file_name;
        }

        $foto_file = $request->file('photo');
        $result = $insert->save();
        Session::flash('success', 'User registered succesfully');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'photo' => 'mimes:png,jpeg,jpg|max:2048'
        ])->validate();
        $update = Kategori::findOrFail($id);
        $update->name = $request->name;
        $update->description = $request->description;

        if ($request->hasfile('photo')){
            $filePath = public_path('uploads');
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);
            //delet old photo
            if (!is_null($update)) {
                $oldImage = public_path('uploads/' . $update);
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $update->photo = $file_name;
        }
        $result = $update->save();
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();
        if (!is_null($kategori->photo)){
            $photo = public_path('uploads/'. $kategori->photo);
            if (File::exists($photo)){
                unlink($photo);
            }
        }
        return redirect()->route('kategori.index');
    }
}
