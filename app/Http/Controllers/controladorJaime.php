<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controladorJaime extends Controller {

    function redirec(Request $req) {
        $boton = $req->get('boton');
        \Session::forget('planta');
        \Session::forget('elementos');

        switch ($boton) {
            case "Administrador":
                return view('admin/admin');
                break;
            case "Laboratorio":
                $plantas = DB::table('plantas')->get();
                \Session::put('plantas', $plantas);
                return view('laboratorio/Laboratorio');
                break;
            case "Ver analisis":
                $plantas = DB::table('plantas')->get();
                \Session::put('plantas', $plantas);
                $datos = ['plantas' => $plantas];
                return view('vista/VerAnalisis', $datos);
                break;
            case "Login":
                return view('login');
                break;
        }
    }

    function compuestos(Request $req) {
        $boton = $req->get('menu');

        \Session::put('planta', $boton);
        $compuestos = DB::select("SELECT * FROM `compuestos` WHERE compuestos.planta = (select plantas.id_planta from plantas where nombre= '" . $boton . "') ORDER by orden");
        \Session::put('compuestos', $compuestos);



        return view('laboratorio/compuesto');
    }

    function elementos(Request $req) {
        $comp = $req->get('compuesto');
        $compuesto = DB::select("SELECT compuestos.compuesto,compuestos.granulometria, compuestos.id_compuesto from compuestos where compuestos.id_compuesto = '" . $comp . "'");
        \Session::put('compuesto', $compuesto);
        $elementos = DB::select("SELECT elementos.* , datos_elementos.describe_elemento FROM elementos, datos_elementos where elementos.compuesto = '" . $comp . "' and datos_elementos.id_elemento= elementos.id_elem order by orden");
        \Session::put('elementos', $elementos);
        $tanques = DB::select("Select tanques.tanque from tanques where id_compuesto='" . $comp . "' ");
        \Session::put('tanques', $tanques);
        if ($compuesto[0]->granulometria != null) {
            $granu = DB::select("SELECT * FROM `granudatos` where id_granu = '" . $compuesto[0]->granulometria . "' ORDER by n");
            \Session::put('granu', $granu);
        }

        return view('laboratorio/elementos');
    }
    function login(Request $req){
        $user = $req->get("user");
        $pass = $req->get("pass");
        $users = DB::select("select * from usuarios where nombre='".$user."' and pass='".$pass."'");
        if (isset($users[0])) {
            return view('inicio');
        }else{
            echo "<script>alert('usuario o contraseña incorrecto'); window.location.href= 'volver';</script>";
        }
    }

}
