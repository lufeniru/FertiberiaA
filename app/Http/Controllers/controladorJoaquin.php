<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controladorJoaquin extends Controller
{
    function introducirDatos(Request $req) {
        /**** las sesiones para coger los campos e insertar **/
        $elementos = \Session::get('elementos');
        $compuesto = \Session::get('compuesto');
        dd ($compuesto[0]->compuesto, $elementos);
        $fecha_hora=$req->get('fechahora');
        $planta=\DB::select("select compuestos.planta from compuestos where compuestos.compuesto='".$compuesto[0]->compuesto."'");
        $valores=($req->get('valor'));
        $tanque=($req->get('tanque'));
        
        $i=0;
        foreach ($valores as $valor) {
            \DB::table('tabla_tocha')->insert([
                'fechahora' => $fecha_hora,
                'planta' => $planta,
                'tanque' => $tanque,
                'id_compuesto' => $compuesto[0]->compuesto,
                'id_elemento' => $elementos[$i]->id_elem,
                'condicion' => $elementos->condicion,
                'valor' => $elementos->valor,
                'simbolo' => $elementos->simbolo,
                'lectura' => $valor
            ]);
            $i++;
        }
        
        
        
        //si hay granulometria
        if ($req->get('granulometria')!=null) {
            $granus=$req->get('granulometria');
        }
        if ($req->get('granulometria')!=null) {
            dd('si');
        }else{
            dd('no');
        }
        
    }
    
    
}
