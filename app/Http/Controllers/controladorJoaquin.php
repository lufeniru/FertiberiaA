<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controladorJoaquin extends Controller {

    function introducirDatos(Request $req) {
        /*         * ** las sesiones para coger los campos e insertar * */
        $elementos = \Session::get('elementos');
        $compuesto = \Session::get('compuesto');
        $fecha_hora = $req->get('fechahora');
        $planta = \DB::select("select compuestos.planta from compuestos where compuestos.compuesto='" . $compuesto[0]->compuesto . "'");
        $valores = ($req->get('valor'));
        $tanque = ($req->get('tanque'));

        $i = 0;
        foreach ($valores as $valor) {
            \DB::table('tabla_tocha')->insert([
                'fechahora' => $fecha_hora,
                'planta' => $planta[0]->planta,
                'tanque' => $tanque,
                'id_compuesto' => $compuesto[0]->id_compuesto,
                'id_elemento' => $elementos[$i]->id_elem,
                'condicion' => $elementos[$i]->condicion,
                'valor1' => $elementos[$i]->valor1,
                'valor2' => $elementos[$i]->valor2,
                'simbolo' => $elementos[$i]->simbolo,
                'lectura' => $valor
            ]);
            $i++;
        }
        //si hay granulometria
        if ($req->get('granulometria') != null) {
            $granus = $req->get('granulometria');
            $gran = \Session::get('granu');
            $i = 0;
            foreach ($granus as $g) {
                \DB::table('tabla_tocha_granu')->insert([
                    'fechahora' => $fecha_hora,
                    'planta' => $planta[0]->planta,
                    'tanque' => $tanque,
                    'id_compuesto' => $compuesto[0]->id_compuesto,
                    'valor_granu' => $gran[$i]->valor,
                    'condicion' => $gran[$i]->condicion,
                    'valor1' => $gran[$i]->valor1,
                    'simbolo' => $gran[$i]->simbolo,
                    'lectura' => $g
                ]);
                $i++;
            }
        }
        echo '<script>alert("Insertado con exito");</script>';
        \Session::forget('planta');
        return view('Laboratorio');
    }
    
    function admin(Request $req){
        if($req->get('menu2')!=null) {
            $opcion=$req->get('menu2');
            switch ($opcion) {
                case 'Añadir planta':
                    return view('addPlanta');
                    break;
                case 'Añadir compuesto':
                    return view('addCompuesto');
                    break;
                case 'Añadir elemento':
                    return view('addElemento');
                    break;
                default:
                    return view('inicio');
                    break;
            }
        }
    }

}
