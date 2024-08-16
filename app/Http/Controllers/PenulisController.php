<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penulis = penulis::latest()->get();
        return view('penulis.index', compact('penulis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'biografi' => 'required',
            'photo' => 'required|mimes:png,jpeg,jpg|max:2048',
        ])->validate();
        
        $filePath = public_path('photo');
        $insert = new Penulis();
        $insert->name = $request->name;
        $insert->biografi = $request->biografi;
        $insert->photo = $request->photo;       
        $insert->slug = $request->slug;       
        
        $words = explode(" ", $insert->name);
        $request->name = implode("-", $words). "-";
        // Inisialisasi variabel untuk menyimpan inisial
        $insert->slug = $request->name;

        // Loop melalui setiap kata
        foreach ($words as $word) {
        // Ambil karakter pertama dari setiap kata dan tambahkan ke inisial
        $insert->slug .= substr($word, 0,1);
        }

        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();

            $file->move($filePath, $file_name);
            $insert->photo = $file_name;
        }

        $foto_file = $request->file('photo');
        $result = $insert->save();
        
        return redirect()->route('penulis.index');
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
        $penulis = penulis::findOrFail($id);
        return view('penulis.edit', compact('penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'biografi' => 'required',
            'photo' => 'mimes:png,jpeg,jpg|max:2048',          
        ])->validate();

        $update = Penulis::findOrFail($id);
        $update->name = $request->name;
        $update->biografi = $request->biografi;
      
        $words = explode(" ", $request->name);
        $request->name = implode("-", $words). "-";
        // Inisialisasi variabel untuk menyimpan inisial
        $update->slug = $request->name;
   
        // Loop melalui setiap kata
        foreach ($words as $word) { 
        // Ambil karakter pertama dari setiap kata dan tambahkan ke inisial
        $update->slug .= substr($word, 0, 1);   
        }
    
    
        if ($request->hasfile('photo')){
            $filePath = public_path('photo');
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);
            //delet old photo
            if (!is_null($update)) {
                $oldImage = public_path('photo/' . $update);
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $update->photo = $file_name;
        }
        
        $result = $update->save();
        return redirect()->route('penulis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penulis = penulis::findOrFail($id);
        $penulis->delete();
        if (!is_null($penulis->photo)){
            $photo = public_path('photo/'. $penulis->photo);
            if (File::exists($photo)){
                unlink($photo);
            }
        }
        return redirect()->route('penulis.index');
    }

    public function getSlug(Request $request) 
    {  
        $slug = SlugService::createSlug(Penulis::class, 'slug', $request->name);
        $slugParts = explode(" ", $request->name);
        $request->name = implode("-", $slugParts). "-";
        $slug = $request->name;
        foreach ($slugParts as $part) {
            $slug .= substr($part, 0, 1); // Ambil karakter pertama dari setiap kata
        }
        $existing_slugs = Penulis::where('slug', 'like', $slug . '%')->pluck('slug')->toArray();
        if (in_array($slug, $existing_slugs)) {
            $slug .= '-' . count($existing_slugs); // Menambahkan nomor jika slug sudah ada
        }
        // $slug .= "-" . strtolower($slug);       
        return response()->json([           
            'slug' => $slug,                    
        ]);  

    }
}
