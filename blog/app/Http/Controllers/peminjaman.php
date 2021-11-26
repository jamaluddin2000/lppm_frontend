<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class peminjaman extends Controller
{
    public function tampilaninputpeminjaman(){
        $data = DB::select('CALL tampilaninputpeminjaman()');
        print_r(json_encode($data));
    }
    public function hapusinputpeminjaman(Request $req){
        $id_detail_peminjaman = $req -> input('id_detail_peminjaman');
        $data = DB::select('CALL hapusinputpeminjaman(?)',array($id_detail_peminjaman));
        return['Message'=>'Data berhasil dihapus'];
    }
}
