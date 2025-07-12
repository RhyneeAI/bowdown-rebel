<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\Expedition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpeditionService 
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekspedisi' => 'required|string|max:30',
            'biaya' => 'required|string',
            'status' => 'required|string|in:' . implode(',', array_column(StatusEnum::cases(), 'value')),
        ], [
            'nama_ekspedisi.required' => 'Nama ekspedisi harus diisi',
            'nama_ekspedisi.string' => 'Nama ekspedisi harus berupa teks',
            'nama_ekspedisi.max' => 'Nama ekspedisi maksimal 30 karakter',
            'biaya.required' => 'Biaya harus diisi',
            'biaya.string' => 'Biaya harus berupa teks',
            'status.required' => 'Status harus diisi',
            'status.string' => 'Status harus berupa teks',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
        }

        $validated = $validator->validated();

        return Expedition::create([
            'nama_ekspedisi' => $validated['nama_ekspedisi'],
            'biaya' => str_replace('.', '', $validated['biaya']),
            'status' => $validated['status'],
        ]);
    }

    public function getAll()
    {
        $expedition = Expedition::select(['id', 'biaya', 'nama_ekspedisi', 'status'])->orderBy('id', 'DESC')->get();
        
        return $expedition;
    }

    public function getOne(String $id = '')
    {
        $expedition = Expedition::select(['id', 'biaya', 'nama_ekspedisi', 'status'])->where('id', $id)->first();
        
        return $expedition;
    }

    public function update(Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekspedisi' => 'required|string|max:30',
            'biaya' => 'required|string',
            'status' => 'required|string|in:' . implode(',', array_column(StatusEnum::cases(), 'value')),
        ], [
            'nama_ekspedisi.required' => 'Nama ekspedisi harus diisi',
            'nama_ekspedisi.string' => 'Nama ekspedisi harus berupa teks',
            'nama_ekspedisi.max' => 'Nama ekspedisi maksimal 30 karakter',
            'biaya.required' => 'Biaya harus diisi',
            'biaya.string' => 'Biaya harus berupa teks',
            'status.required' => 'Status harus diisi',
            'status.string' => 'Status harus berupa teks',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
        }

        $validated = $validator->validated();

        $expedition = Expedition::where('id', $id)->firstOrFail();

        $expedition->update([
            'nama_ekspedisi' => $validated['nama_ekspedisi'],
            'biaya' => str_replace('.', '', $validated['biaya']),
            'status' => $validated['status'],
        ]);

        return $expedition;
    }

    public function delete(String $id) 
    {
        $expedition = Expedition::where('id', $id)->firstOrFail();

        return $expedition->delete();
    }

}