<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function index($slug)
    {
        $presence = Presence::where('slug', $slug)->first();
        $presenceDetails = PresenceDetail::where('presence_id', $presence->id)->get();
        return view('pages.absensi.index', compact('presence', 'presenceDetails'));
    }

    public function save(Request $request,string $id)
    {
        $presence = Presence::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'asal_instansi' => 'required',
            'signature' => 'required',
        ]);

        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->jabatan = $request->jabatan;
        $presenceDetail->asal_instansi = $request->asal_instansi;

        // decode signature image
        $base64_image = $request->signature;
        @list($type, $base64_image) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $base64_image);

        // generate nama file
        $uniqChar = date('YmdHis').uniqid();
        $signature = "tanda-tangan/{$uniqChar}.png";

        // simpan gambar ke publik
        Storage::disk('public_uploads')->put($signature, base64_decode($file_data));

        $presenceDetail->signature = $signature;
        $presenceDetail->save();

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }

}
