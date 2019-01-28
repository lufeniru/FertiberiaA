<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controladorJaime extends Controller {

    function redirec(Request $req) {
        $boton = $req->get('boton');
        \Session::forget('planta');
        \Session::forget('elementos');
        if ($boton == 'Administrador') {
            return view('Admin');
        } else {
            $plantas = DB::table('plantas')->get();

            $datos = ['plantas' => $plantas];


            return view('Laboratorio', $datos);
        }
    }

    function compuestos(Request $req) {
        $boton = $req->get('menu');

        \Session::put('planta', $boton);
        $compuestos = DB::select("SELECT * FROM `compuestos` WHERE compuestos.planta = (select plantas.id_planta from plantas where nombre= '" . $boton . "') ORDER by orden");
        \Session::put('compuestos', $compuestos);



        return view('compuesto');
    }

    function elementos(Request $req) {
        $comp = $req->get('compuesto');
         $compuesto= DB::select("SELECT compuestos.compuesto,compuestos.granulometria from compuestos where compuestos.id_compuesto = '".$comp."'");
         \Session::put('compuesto',$compuesto);
        $elementos = DB::select("SELECT elementos.* , datos_elementos.describe_elemento FROM elementos, datos_elementos where elementos.compuesto = '".$comp."' and datos_elementos.id_elemento= elementos.id_elem order by orden");
        \Session::put('elementos', $elementos);
        $tanques= DB::select("Select tanques.tanque from tanques where id_compuesto='".$comp."' ");
        \Session::put('tanques', $tanques);
        if ($compuesto[0]->granulometria != null) {
            dd($compuesto);
        }
        
        return view('elementos');
    }

}
