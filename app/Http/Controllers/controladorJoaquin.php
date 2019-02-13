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
            $prog = 0;
        } else {
            $prog = 1;
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
        return view('laboratorio/Laboratorio');
    }

    function admin(Request $req) {

        $opcion = $req->get('menu2');
        switch ($opcion) {
            case 'Añadir planta':
                return view('admin/addPlanta');
                break;
            case 'Añadir compuesto':
                $plantas = \DB::table('plantas')->get();
                $datos = ['plantas' => $plantas];
                return view('admin/addComp', $datos);
                break;
            case 'Añadir elemento':
                $plantas = \DB::table('plantas')->get();
                $comp = $this->comp($plantas[0]->id_planta);
                $datos = ['plantas' => $plantas,
                    'comp'=>$comp];
                 
                return view('admin/addElemento', $datos);
                break;
            default:
                return view('inicio');
                break;
        }
    }

    function addElemento(Request $req) {
        $compuesto = $req->get('comp');
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
        \DB::table('datos_elementos')->insert([
            'id_elemento' => $idElem,
            'describe_elemento' => $nombreElem,
        ]);

        /*         * * comprobar cuantos elementos hay en ese compuesto, para aplicar el orden* */
        $nElementos = \DB::select('select count(*) as resultados from elementos where compuesto like "' . $compuesto . '"');
        $nElementos[0]->resultados++;
        $vector = [
            'orden' => $nElementos[0]->resultados,
            'id_elem' => $idElem,
            'condicion' => $condicion,
            'valor1' => $valor1,
            'valor2' => $valor2,
            'simbolo' => $simbolo,
            'compuesto' => $compuesto
        ];

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

    function addComp(Request $req) {
        $planta = $req->get('planta');
        $nombre = $req->get('nombreComp');
        $id = $req->get('idComp');

        /** comprobar si el compuesto tiene granulometria ** */
        if ($req->get('granulometria') == 'on') {
            $especificaciones = $req->get('valor');
            $condiciones = $req->get('condicion');
            $valores = $req->get('valor1');
            $simbolos = $req->get('simbolo');

            /*             * * numero de insert en granudatos ******** */
            $cuantos = $req->get('cuantos');

            /*             * * poner la nueva granulometria ** */
            $count = \DB::select("select count(*) as cuantos from granulometrias");
            $count[0]->cuantos++;
            $idGranu = 'G' . $count[0]->cuantos;
            $descripcion = 'Granulometría de ' . $nombre;

            /*             * * insertar en tabla granulometrias ** */
            \DB::table('granulometrias')->insert([
                'id_granulometria' => $idGranu,
                'descripcion' => $descripcion,
            ]);

            /*             * * insertar en tabla granudatos*** */
            for ($i = 0; $i < $cuantos; $i++) {
                $j = $i+1;
                \DB::table('granudatos')->insert([
                    'id_granu' => $idGranu,
                    'n' => $j,
                    'valor' => $especificaciones[$i],
                    'condicion' => $condiciones[$i],
                    'valor1' => $valores[$i],
                    'simbolo' => $simbolos[$i]
                ]);
            }

            /*             * * insertar el compuesto con el id de la granulometria ** */
            \DB::table('compuestos')->insert([
                'id_compuesto' => $id,
                'compuesto' => $nombre,
                'planta' => $planta,
                'granulometria' => $idGranu
            ]);
            
        } else { /*         * * sino insertamos solo el compuesto ** */
            \DB::table('compuestos')->insert([
                'id_compuesto' => $id,
                'compuesto' => $nombre,
                'planta' => $planta,
            ]);
        }
        return view('inicio');
    }

    function addPlanta(Request $req) {
        $nombre = $req->get('nombre');
        $desc = $req->get('descripcion');
        \DB::table('plantas')->insert(
                ['nombre' => $nombre, 'descripcion' => $desc]
        );
        echo '<script>alert("' . $desc . ' añadida con exito");</script>';
        return view('inicio');
    }

    function sacarcomp() {
        $p = $_POST['planta'];
        $compuestos = \DB::select("SELECT id_compuesto, compuesto FROM `compuestos` where planta =" . $p);
        $select = '<h4>Compuestos:</h4> <select name="comp" class="custom-select">';
        foreach ($compuestos as $v) {
            $select = $select . '<option value="' . $v->id_compuesto . '">' . $v->compuesto . '</option>';
        }
        $select = $select . '</select>';
        return $select;
    }
    function comp($planta) {
        
        $compuestos = \DB::select("SELECT id_compuesto, compuesto FROM `compuestos` where planta =" . $planta);
        $select = '<h4>Compuestos:</h4> <select name="comp" class="custom-select">';
        foreach ($compuestos as $v) {
            $select = $select . '<option value="' . $v->id_compuesto . '">' . $v->compuesto . '</option>';
        }
        $select = $select . '</select>';
        return $select;
    }

}
