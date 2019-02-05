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
        $prog = $req->get('prog');
        if ($prog === 'on') {
            $prog= 0;
        }
        else{
            $prog=1;
        }
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
                'lectura' => $valor,
                'programado' => $prog
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

    function admin(Request $req) {
        if ($req->get('menu2') != null) {
            $opcion = $req->get('menu2');
            switch ($opcion) {
                case 'Añadir planta':
                    return view('addPlanta');
                    break;
                case 'Añadir compuesto':
                    
                    return view('addCompuesto');
                    break;
                case 'Añadir elemento':
                    $plantas = \DB::table('plantas')->get();
                    $datos= [ 'plantas' => $plantas];
                    return view('addElemento',$datos);
                    break;
                default:
                    return view('inicio');
                    break;
            }
        }
    }

    function addElemento(Request $req) {
        $compuesto = $req->get('compuesto');
        $nombreElem = $req->get('nombreElemento');
        $idElem = $req->get('idElem');
        $condicion = null;
        if ($req->get('condicion') != 'null') {
            $condicion = $req->get('condicion');
        }
        $valor1 = $req->get('valor1');
        $valor2 = null;
        if ($req->get('valor2') != 0) {
            $valor2 = $req->get('valor2');
        }
        $simbolo = $req->get('simbolo');
        //dd($compuesto,$nombreElem,$idElem,$condicion,$valor1,$valor2,$simbolo);
        /*         * * insercion en tabla: datos_elementos*** */
        \DB::table('datos_elementos')->insert([
            'id_elemento' => $idElem,
            'describe_elemento' => $nombreElem,
        ]);

        /*         * * comprobar cuantos elementos hay en ese compuesto, para aplicar el orden* */
        $nElementos = \DB::select('select count(*) as resultados from elementos where compuesto like "' . $compuesto . '"');
        $nElementos[0]->resultados++;
        $vector=[
            'orden' => $nElementos[0]->resultados,
            'id_elem' => $idElem,
            'condicion' => $condicion,
            'valor1' => $valor1,
            'valor2' => $valor2,
            'simbolo' => $simbolo,
            'compuesto' => $compuesto
        ];
        //dd($vector);
        /** insercion en tabla: elemento *** */
        \DB::table('elementos')->insert([
            'orden' => $nElementos[0]->resultados,
            'id_elem' => $idElem,
            'condicion' => $condicion,
            'valor1' => $valor1,
            'valor2' => $valor2,
            'simbolo' => $simbolo,
            'compuesto' => $compuesto
        ]);
        return view('inicio');
    }

}
