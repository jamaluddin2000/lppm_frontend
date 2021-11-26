<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class peminjam extends Controller
{
    public function tampilaninputpeminjam(){
        $data = DB::select('CALL tampilaninputpeminjam()');
        print_r(json_encode($data));
    }
    public function hapusinputpeminjam(Request $req){
        $kartu_perpus = $req -> input('kartu_perpus');
        $data = DB::select('CALL hapusinputpeminjam(?)',array($kartu_perpus));
        return['Message'=>'Data berhasil dihapus'];
    }
    
    public function tambahinputpeminjam(Request $req){
        $id_kartu = $req -> input('id_kartu');
        $nama_peminjam = $req -> input('nama_peminjam');
        $umur = $req -> input('umur');
        $alamat = $req -> input('alamat');
        $data = DB::select('CALL tambahinputpeminjam(?,?,?,?)',array($id_kartu,$nama_peminjam,$umur,$alamat));
        return['Message'=>'Data berhasil ditambahkan'];
    }
    
}
