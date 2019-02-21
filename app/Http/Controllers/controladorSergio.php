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



        return view('vista/compuestoAnalisis');
    }

    function verelementos(Request $req) {
        $comp;
        //Controlamos la recarga y la primera entrada.
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
        date_default_timezone_set('Europe/Madrid');
        $fecha = date("Y-m-d");
        
        if (isset($req->fecha)) {
            $fecha = $req->fecha;
        }
        $fechah = $fecha;
        if(isset($req->fechah))
        {
            $fechah=$req->fechah;
        }
        $tanque;
        if (isset($req->tanque)) {
            $tanque = $req->tanque;
        } else {
            $tanque = $tanques[0]->tanque;
        }
        
        $validado=2;
        if(isset($req->validado))
        {
            $validado=$req->validado;
        }
        $programado=2;
        if(isset($req->programado))
        {
            $programado=$req->programado;
        }
        
        $filtros="";
        if($programado!=2)
        {
            $filtros=$filtros." AND tabla_tocha.programado=".$programado;
        }
        if($validado!=2)
        {
            $filtros=$filtros." AND tabla_tocha.validado=".$validado;
        }
          

        
        //Hay que sececcionar las fechas y enviarlas ordenadas por mas actual primero.
        $nelementos = DB::select("SELECT COUNT(id_elem) AS nelem FROM `elementos` WHERE compuesto='" . $comp . "'");
        $tabla = DB::select("SELECT tabla_tocha.fechahora,tabla_tocha.id_elemento,tabla_tocha.valor1,tabla_tocha.valor2,tabla_tocha.simbolo,tabla_tocha.lectura,tabla_tocha.condicion,elementos.orden,datos_elementos.describe_elemento, tabla_tocha.programado, tabla_tocha.validado
                            FROM tabla_tocha,elementos,datos_elementos
                            WHERE tabla_tocha.id_elemento=elementos.id_elem AND elementos.id_elem=datos_elementos.id_elemento AND elementos.compuesto='" . $comp . "' AND tabla_tocha.id_compuesto='" . $comp . "' AND DATE_FORMAT(fechahora,'%Y-%m-%d') BETWEEN '".$fecha."' and '".$fechah."' AND tabla_tocha.tanque='" . $tanque . "'
                                ".$filtros."
                            ORDER BY tabla_tocha.fechahora, elementos.orden;");
        if (isset($granu)) {
            $ngranu = DB::select("SELECT COUNT(`id_granu`) as ngran FROM granudatos WHERE granudatos.id_granu='" . $granu[0]->id_granu . "'");
        }
        $tgranu = DB::select("SELECT * 
                            FROM tabla_tocha_granu
                            WHERE DATE_FORMAT(fechahora,'%Y-%m-%d') BETWEEN '".$fecha."' and '".$fechah."' AND tabla_tocha_granu.id_compuesto='" . $comp . "' AND tabla_tocha_granu.tanque='" . $tanque . "'");
       
        
        //Eliminamos los elementos de granulometria que no cumplan con los filtros de la cadena filtros.
        $tgranul= null; 
        unset($tgranul[0]);
        for($i=0; $i< count($tgranu) ; $i+= $ngranu[0]->ngran)
        {
            $elementog=$tgranu[$i];
            $ch=false;
            for($e=0; $e < count($tabla) ; $e+= $nelementos[0]->nelem)
            {
               $elementot= $tabla[$e];
               if($elementot->fechahora==$elementog->fechahora)
               {
                   $ch=true;
               }
            }
            if($ch)
            {
                for($o=$i; $o<$i+$ngranu[0]->ngran ; $o++)
                {
                    //unset($tgranu[$o]);
                    if($tgranul==null)
                    {
                        $tgranul = [$tgranu[$o]];
                    }
                    else
                    {
                        array_push($tgranul,$tgranu[$o]);
                    }
                }
            }
        }
        //Si tgranul viene a null significa que la tabla va vacia y no hay nada que mostrar, asi que igualamos tgranu a tabla para que no tenga dimension
        if($tgranul!=null)
        {
            $tgranu=$tgranul;
        }
        else 
        {
            $tgranu=$tabla;
        }
        
        //Vamos a dividir la tabla en filas correspondientes a los registros.
        $tabnor=null;
        $fil=null;
        foreach ($tabla as $i=> $fila)
        {           
            if($fil==null)
            {
                $fil[] = $fila;
                
            }
            else
            {
                array_push($fil, $fila);
            }
            
            if($i>0)
            {
                if(($i+1) % $nelementos[0]->nelem == 0)
                {   
                    if($tabnor==null)
                    {
                        $tabnor[]=$fil;
                        $fil=null;
                    }
                    else
                    {
                        array_push($tabnor,$fil);
                        $fil=null;
                    }
                }
            }
        }

        $tabla=$tabnor;
        //Ahora la tabla en tabnor esta guardada por filas.
        //Vamos a dividir la tabla de granulometria en filas correspondientes a la granulometria.
        $tabnor=null;
        $fil=null;
        foreach ($tgranu as $i=> $fila)
        {           
            if($fil==null)
            {
                $fil[] = $fila;
                
            }
            else
            {
                array_push($fil, $fila);
            }
            
            if($i>0)
            {
                if(($i+1) % $ngranu[0]->ngran == 0)
                {   
                    if($tabnor==null)
                    {
                        $tabnor[]=$fil;
                        $fil=null;
                    }
                    else
                    {
                        array_push($tabnor,$fil);
                        $fil=null;
                    }
                }
            }
        }
        $tgranu=$tabnor;
        
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
            'fecha' => $fecha,
            'fechah' => $fechah,
            'validado' => $validado,
            'programado' => $programado
        ];
        return view('vista/elementosAnalisis', $datos);
    }

    public function recelal() {
        $ret ="hola";
        return $ret;
    }
}
