<?php

namespace App\Http\Controllers;

use App\PublikasiIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PublikasiIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publikasi_ilmiah = PublikasiIlmiah::latest()->paginate(10);
        return view('admin.publikasi_ilmiah.index', compact('publikasi_ilmiah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publikasi_ilmiah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'peneliti' => 'required',
            'judul' => 'required',
            'fokus_riset' => 'required',
            'deskripsi' => 'required',
            'manfaat' => 'required',
            'foto' => 'required',
            'tahun' => 'required',
        ]);

        $foto = $request->foto;
        $new_foto = time() . $foto->getClientOriginalName();

        $publikasi_ilmiah = PublikasiIlmiah::create([
            'peneliti' => $request->peneliti,
            'judul' => $request->judul,
            'fokus_riset' => $request->fokus_riset,
            'deskripsi' => $request->deskripsi,
            'manfaat' => $request->manfaat,
            'tahun' => $request->tahun,
            'foto' => 'public/uploads/publikasi-ilmiah/' . $new_foto,
            'slug' => Str::slug($request->judul)
        ]);

        $foto->move('public/uploads/publikasi-ilmiah/', $new_foto);
        return redirect()->route('publikasi-ilmiah.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publikasi_ilmiah = PublikasiIlmiah::findorfail($id);
        return view('admin.publikasi_ilmiah.edit', compact('publikasi_ilmiah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'peneliti' => 'required',
            'judul' => 'required',
            'fokus_riset' => 'required',
            'deskripsi' => 'required',
            'manfaat' => 'required',
            'tahun' => 'required',
        ]);

        $publikasi_ilmiah = PublikasiIlmiah::findorfail($id);

        if ($request->has('foto')) {
            $foto = $request->foto;
            $new_foto = time() . $foto->getClientOriginalName();
            $foto->move('public/uploads/publikasi-ilmiah/', $new_foto);

            $post_data = [
                'peneliti' => $request->peneliti,
                'judul' => $request->judul,
                'fokus_riset' => $request->fokus_riset,
                'deskripsi' => $request->deskripsi,
                'manfaat' => $request->manfaat,
                'foto' => 'public/uploads/publikasi-ilmiah/' . $new_foto,
                'tahun' => $request->tahun,
                'slug' => Str::slug($request->judul)
            ];
        } else {
            $post_data = [
                'peneliti' => $request->peneliti,
                'judul' => $request->judul,
                'fokus_riset' => $request->fokus_riset,
                'deskripsi' => $request->deskripsi,
                'manfaat' => $request->manfaat,
                'tahun' => $request->tahun,
                'slug' => Str::slug($request->judul)
            ];
        }

        $publikasi_ilmiahn->update($post_data);
        return redirect()->route('publikasi-ilmiah.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publikasi_ilmiah = PublikasiIlmiah::findorfail($id);
        $publikasi_ilmiah->delete();
        return redirect()->route('publikasi-ilmiah.index')->with('success', 'Data berhasil dihapus');
    }
}
