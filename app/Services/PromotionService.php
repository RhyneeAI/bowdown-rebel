<?php

namespace App\Services;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionService 
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_promosi' => 'required|string|max:30',
            'stok' => 'required|integer|min:1',
            'diskon_harga' => 'required|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
        }

        $validated = $validator->validated();

        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = UploadFile('promotions', $request->file('foto'));
        }

        return Promotion::create([
            'kode_promosi' => $validated['kode_promosi'],
            'stok' => $validated['stok'],
            'diskon_harga' => ParseRupiah($validated['diskon_harga']),
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_berakhir' => $validated['tanggal_berakhir'],
            'foto' => $filename,
            'slug' => MakeSlug($validated['kode_promosi']),

        ]);
    }

    public function getAll()
    {
        $promotion = Promotion::select(['id', 'kode_promosi','stok','diskon_harga','tanggal_mulai','tanggal_berakhir','foto','slug'])->orderBy('id', 'DESC')->get();
        return $promotion;
    }

    public function getAllWithPaginate(Int $paginate)
    {
        $promotion = Promotion::select(['id', 'kode_promosi','stok','diskon_harga','tanggal_mulai','tanggal_berakhir','foto','slug'])->orderBy('id', 'DESC')->paginate($paginate);
        return $promotion;
    }

    public function getOne(String $slug = '')
    {
        $promotion = Promotion::select(['id','kode_promosi','stok','diskon_harga','tanggal_mulai','tanggal_berakhir','foto','slug'])->where('slug', $slug)->first();
        return $promotion;
    }

    public function update(Request $request, String $slug)
    {
        $validator = Validator::make($request->all(), [
            'kode_promosi' => 'required|string|max:30',
            'stok' => 'required|integer|min:1',
            'diskon_harga' => 'required|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
        }

        $validated = $validator->validated();

        $promotion = Promotion::where('slug', $slug)->firstOrFail();
        $filename = $promotion->foto; 
        if ($request->hasFile('foto')) {
            if($filename) {
                DeleteFile('promotions', $promotion->foto);
            }

            $filename = UploadFile('promotions', $request->file('foto'));
        }   

        $promotion->update([
            'kode_promosi' => $validated['kode_promosi'],
            'stok' => $validated['stok'],
            'diskon_harga' => ParseRupiah($validated['diskon_harga']),
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_berakhir' => $validated['tanggal_berakhir'],
            'foto' => $filename,
            'slug' => MakeSlug($validated['kode_promosi']),
        ]);

        return $promotion;
    }

    public function delete(String $slug) 
    {
        $promotion = Promotion::where('slug', $slug)->firstOrFail();

        if ($promotion->foto) {
            DeleteFile('promotions', $promotion->foto);
        }

        return $promotion->delete();
    }

}