<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class controladorSergio extends Controller {

    function vercompuestos(Request $req) {
        $boton = $req->get('menu');

        \Session::put('planta', $boton);
        $compuestos = DB::select("SELECT * FROM `compuestos` WHERE compuestos.planta = (select plantas.id_planta from plantas where nombre= '" . $boton . "') ORDER by orden");
        \Session::put('compuestos', $compuestos);



        return view('compuestoAnalisis');
    }

    function verelementos(Request $req) {
        $comp;
        if (isset($req->comp)) {
            $comp = $req->get('comp');
        } else {
            $comp = $req->get('compuesto');
        }
        $compuesto = DB::select("SELECT compuestos.compuesto,compuestos.granulometria from compuestos where compuestos.id_compuesto = '" . $comp . "'");
        \Session::put('compuesto', $compuesto);
        $elementos = DB::select("SELECT elementos.* , datos_elementos.describe_elemento FROM elementos, datos_elementos where elementos.compuesto = '" . $comp . "' and datos_elementos.id_elemento= elementos.id_elem order by orden");
        \Session::put('elementos', $elementos);
        $tanques = DB::select("Select tanques.tanque from tanques where id_compuesto='" . $comp . "' ");
        \Session::put('tanques', $tanques);
        if ($compuesto[0]->granulometria != null) {
            $granu = DB::select("SELECT * FROM `granudatos` where id_granu = '" . $compuesto[0]->granulometria . "' ORDER by n");
            \Session::put('granu', $granu);
        }
        ////////////////////////////////////////////////////////////////////////
        $fecha = date("Y-m-d");
        $tanque;
        if (isset($req->fecha)) {
            $fecha = $req->fecha;
        }

        if (isset($req->tanque)) {
            $tanque = $req->tanque;
        } else {
            $tanque = $tanques[0]->tanque;
        }
        //Hay que sececcionar las fechas y enviarlas ordenadas por mas actual primero.
        $nelementos = DB::select("SELECT COUNT(id_elem) AS nelem FROM `elementos` WHERE compuesto='" . $comp . "'");
        $tabla = DB::select("SELECT tabla_tocha.fechahora,tabla_tocha.id_elemento,tabla_tocha.valor1,tabla_tocha.valor2,tabla_tocha.simbolo,tabla_tocha.lectura,tabla_tocha.condicion,elementos.orden,datos_elementos.describe_elemento, tabla_tocha.programado, tabla_tocha.validado
                            FROM tabla_tocha,elementos,datos_elementos
                            WHERE tabla_tocha.id_elemento=elementos.id_elem AND elementos.id_elem=datos_elementos.id_elemento AND elementos.compuesto='" . $comp . "' AND tabla_tocha.id_compuesto='" . $comp . "' AND tabla_tocha.fechahora LIKE '%" . $fecha . "%' AND tabla_tocha.tanque='" . $tanque . "'
                            ORDER BY tabla_tocha.fechahora, elementos.orden;");
        if (isset($granu)) {
            $ngranu = DB::select("SELECT COUNT(`id_granu`) as ngran FROM granudatos WHERE granudatos.id_granu='" . $granu[0]->id_granu . "'");
        }
        $tgranu = DB::select("SELECT * 
                            FROM tabla_tocha_granu
                            WHERE tabla_tocha_granu.fechahora LIKE '%" . $fecha . "%' AND tabla_tocha_granu.id_compuesto='" . $comp . "' AND tabla_tocha_granu.tanque='" . $tanque . "'");
       
       $ngran = '';
        if(isset($ngranu[0]->ngran)){
        $ngran= $ngranu[0]->ngran;
            
        }
        $datos = [
            'compuesto' => $comp,
            'nelementos' => $nelementos[0]->nelem,
            'ngranulometria' => $ngran,
            'tabla' => $tabla,
            'tgranu' => $tgranu,
            'fecha' => $fecha
        ];
        return view('elementosAnalisis', $datos);
    }

}
