<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class buku extends Controller
{
    public function tampilaninput($id_bukuinput){
        $data = DB::select('CALL tampilaninput('.$id_bukuinput.')');
        print_r(json_encode($data));
    }

    public function hapusinputbuku(Request $req){
        $id_buku = $req -> input('id_buku');
        $data = DB::select('CALL hapusinputbuku(?)',array($id_buku));
        return['Message'=>'Data berhasil dihapus'];
    }

    public function tambahinput(Request $req){
        $input_nama_buku = $req -> input('nama_buku');
        $input_id_buku = $req -> input('id_buku');
        $input_jumlah = $req -> input('jumlah');
        $data = DB::select('CALL tambahinput(?,?,?)',array($input_nama_buku,$input_id_buku,$input_jumlah));
        return['Message'=>'Data berhasil ditambahkan'];
    }
    
}

