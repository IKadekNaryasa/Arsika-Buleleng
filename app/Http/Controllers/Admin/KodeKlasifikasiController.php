<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\KodeKlasifikasi;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KodeKlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klasifikasies = KodeKlasifikasi::all();
        $data = [
            'active' => 'dataKlasifikasi',
            'open' => 'klasifikasi',
            'link' => 'Data Kode Klasifikasi',
            'klasifikasies' => $klasifikasies
        ];

        return view('admin.klasifikasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'createKode',
            'open' => 'klasifikasi',
            'link' => 'Add New Kode Klasifikasi',
        ];

        return view('admin.klasifikasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            'kode' => 'required|string',
            Rule::unique('klasifikasis', 'kode'),
            'keterangan' => 'required|string',
        ], [
            'kode.required' => 'The field kode is required',
            'kode.string' => 'The field kode must be a string',
            'keterangan.required' => 'The field code is required',
            'keterangan.string' => 'The field code must be a string',
            'kode.unique' => 'The field kode has already been taken',
        ]);
        try {
            KodeKlasifikasi::create([
                'kode' => $credential['kode'],
                'keterangan' => $credential['keterangan'],
            ]);

            return redirect()->route('admin.klasifikasi.index')->with('success', 'Success, New bidang created!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to add new bidang'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KodeKlasifikasi $kodeKlasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KodeKlasifikasi $klasifikasi)
    {
        $data = [
            'active' => '',
            'open' => 'klasifikasi',
            'link' => 'Edit Data Kode Klasifikasi',
            'klasifikasi' => $klasifikasi
        ];

        return view('admin.klasifikasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KodeKlasifikasi $klasifikasi)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => [
                    'required',
                    'string',
                    Rule::unique('kode_klasifikasis', 'kode')->ignore($klasifikasi->id),
                ],
                'keterangan' => [
                    'required',
                    'string',
                    Rule::unique('kode_klasifikasis', 'keterangan')->ignore($klasifikasi->id),
                ],
            ],
            [
                'kode.required' => 'The field kode is required',
                'kode.string' => 'The field kode must be a string',
                'kode.unique' => 'The field kode has already been taken',
                'keterangan.required' => 'The field keterangan is required',
                'keterangan.string' => 'The field keterangan must be a string',
                'keterangan.unique' => 'The field keterangan has already been taken',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $credential = $validator->validated();

        try {
            $klasifikasi->update([
                'kode' => $credential['kode'],
                'keterangan' => $credential['keterangan'],
            ]);

            return redirect()->route('admin.klasifikasi.index')->with('success', 'Success, Kode Klasifikasi Updated!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to Update Kode Klasifikasi!'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KodeKlasifikasi $kodeKlasifikasi)
    {
        //
    }
}
