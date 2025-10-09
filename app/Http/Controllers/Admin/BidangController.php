<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidang = Bidang::all();
        $data = [
            'active' => 'dataBidang',
            'open' => 'bidang',
            'link' => 'Data Bidang',
            'bidangs' => $bidang
        ];

        return view('admin.bidang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'createBidang',
            'open' => 'bidang',
            'link' => 'Add New Bidang',
        ];

        return view('admin.bidang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bidang' => 'required|string',
            'kode_bidang' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $credential = $validator->validate();
        try {
            Bidang::create([
                'nama_bidang' => ucwords(strtolower(e($credential['nama_bidang']))),
                'kode_bidang' => ucwords(strtoupper(e($credential['kode_bidang']))),
            ]);
            return redirect()->route('admin.bidang.index')->with('success', 'Success, New bidang created!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to add new bidang']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bidang $bidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        $data = [
            'active' => '',
            'open' => 'bidang',
            'link' => 'Edit Data Bidang',
            'bidang' => $bidang
        ];

        return view('admin.bidang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidang $bidang)
    {
        $validator = Validator::make($request->all(), [
            'nama_bidang' => [
                'required',
                'string',
                Rule::unique('bidangs', 'nama_bidang')->ignore($bidang->id),
            ],
            'kode_bidang' => [
                'required',
                'string',
                Rule::unique('bidangs', 'kode_bidang')->ignore($bidang->id),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $credential = $validator->validate();

        try {
            $bidang->update([
                'nama_bidang' => ucwords(strtolower(e($credential['nama_bidang']))),
                'kode_bidang' => ucwords(strtoupper(e($credential['kode_bidang']))),
            ]);

            return redirect()->route('admin.bidang.index')->with('success', 'Success, Bidang Updated!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to Update Bidang!'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidang $bidang)
    {
        //
    }
}
