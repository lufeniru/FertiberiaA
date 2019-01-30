<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class controladorSergio extends Controller
{
   function vercompuestos(Request $req) {
        $boton = $req->get('menu');

        \Session::put('planta', $boton);
        $compuestos = DB::select("SELECT * FROM `compuestos` WHERE compuestos.planta = (select plantas.id_planta from plantas where nombre= '" . $boton . "') ORDER by orden");
        \Session::put('compuestos', $compuestos);

        return view('compuestoAnalisis');
    }
    
    function verelementos(Request $req) {
        $comp = $req->get('compuesto');
        $compuesto= DB::select("SELECT compuestos.compuesto,compuestos.granulometria from compuestos where compuestos.id_compuesto = '".$comp."'");
        \Session::put('compuesto',$compuesto);
        $elementos = DB::select("SELECT elementos.* , datos_elementos.describe_elemento FROM elementos, datos_elementos where elementos.compuesto = '".$comp."' and datos_elementos.id_elemento= elementos.id_elem order by orden");
        \Session::put('elementos', $elementos);
        $tanques= DB::select("Select tanques.tanque from tanques where id_compuesto='".$comp."' ");
        \Session::put('tanques', $tanques);
        if ($compuesto[0]->granulometria != null) {
            $granu = DB::select("SELECT * FROM `granudatos` where id_granu = '".$compuesto[0]->granulometria."' ORDER by n");
            \Session::put('granu',$granu);
        }
        
        
        //Hay que sececcionar las fechas y enviarlas ordenadas por mas actual primero.
        
        return view('elementosAnalisis');
    }
}
