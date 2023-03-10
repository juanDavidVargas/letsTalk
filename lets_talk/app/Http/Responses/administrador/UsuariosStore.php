<?php

namespace App\Http\Responses\administrador;

use App\User;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\administrador\UsuariosShow;

class UsuariosStore implements Responsable
{
    public function toResponse($request)
    {
        $usuarioShow = new UsuariosShow();
        $nombres = request('nombres', null);
        $apellidos = request('apellidos', null);
        $id_tipo_documento = request('id_tipo_documento', null);
        $numero_documento = request('numero_documento', null);
        $id_municipio_nacimiento = request('id_municipio_nacimiento', null);
        $fecha_nacimiento = request('fecha_nacimiento', null);
        $genero = request('genero', null);
        $estado = request('estado', null);
        $telefono = request('telefono', null);
        $celular = request('celular', null);
        $correo = request('correo', null);
        $contacto2 = request('contacto2', null);
        $contacto_opcional = request('contacto_opcional', null);
        $direccion_residencia = request('direccion_residencia', null);
        $id_municipio_residencia = request('id_municipio_residencia', null);
        $id_rol = request('id_rol', null);
        $skype = request('skype', null);
        $zoom = request('zoom', null);
        $id_nivel = request('id_nivel', null);
        $id_tipo_ingles = request('id_tipo_ingles', null);

        if(isset($id_rol) && $id_rol == 3)
        {
            $nivel_ingles = $id_nivel;
            $tipo_ingles = null;

        } else
        {
            $nivel_ingles = null;
            $tipo_ingles = $id_tipo_ingles;
        }

        // Consultamos si ya existe un usuario con la cedula ingresada
        $consulta_cedula = $usuarioShow->consultarCedula($numero_documento);

        if(isset($consulta_cedula) && !empty($consulta_cedula) &&
           !is_null($consulta_cedula))
        {
            alert()->info('Info', 'The document number already exists.');
            return back();
        } else {

            // Contruimos el nombre de usuario
            $separar_apellidos = explode(" ", $apellidos);
            $usuario = substr($this->quitarCaracteresEspeciales(trim($nombres)), 0,1) . trim($this->quitarCaracteresEspeciales($separar_apellidos[0]));
            $usuario = preg_replace("/(??|??)/", "n", $usuario);
            $usuario = strtolower($usuario);
            $complemento = "";

            while($this->consultaUsuario($usuario.$complemento))
            {
                $complemento++;
            }

            $fecha_nacimiento = strtotime($fecha_nacimiento);
            $fecha_ingreso_sistema = Carbon::now()->timestamp;

            DB::connection('mysql')->beginTransaction();

            try {

                $nuevo_usuario = User::create([
                    'usuario' => $usuario.$complemento,
                    'password' => Hash::make($numero_documento),
                    'nombres' => strtoupper($nombres),
                    'apellidos' => strtoupper($apellidos),
                    'numero_documento' => $numero_documento,
                    'id_tipo_documento' => $id_tipo_documento,
                    'id_municipio_nacimiento' => $id_municipio_nacimiento,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'genero' => $genero,
                    'estado' => $estado,
                    'telefono' => $telefono,
                    'celular' => $celular,
                    'correo' => $correo,
                    'contacto2' => $contacto2,
                    'contacto_opcional' => $contacto_opcional,
                    'direccion_residencia' => $direccion_residencia,
                    'id_municipio_residencia' => $id_municipio_residencia,
                    'fecha_ingreso_sistema' => $fecha_ingreso_sistema,
                    'id_rol' => $id_rol,
                    'skype' => $skype,
                    'zoom' => $zoom,
                    'id_nivel' => $nivel_ingles,
                    'id_tipo_ingles' => $tipo_ingles,
                    'clave_fallas' => 0
                ]);

                if($nuevo_usuario)
                {
                    DB::connection('mysql')->commit();
                    alert()->success('Successful Process', 'User successfully created, the user name is: ' . $nuevo_usuario->usuario . ' and the password is: ' . $numero_documento);
                    return redirect()->to(route('administrador.index'));

                } else {
                    DB::connection('mysql')->rollback();
                    alert()->error('Error', 'An error has occurred creating the user, please contact support.');
                    return redirect()->to(route('administrador.index'));
                }

            } catch (Exception $e)
            {
                DB::connection('mysql')->rollback();
                alert()->error('Error', 'An error has occurred creating the user, try again, if the problem persists contact support.');
                return back();
            }
        }
    }

    private function consultaUsuario($usuario)
    {
        try {

            $usuario = User::where('usuario', $usuario)
                            ->get()
                            ->first();
            return $usuario;

        } catch (Exception $e) {
            alert()->error('Error', 'An error has occurred, try again, if the problem persists contact support.');
            return back();
        }
    }

    private function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = array("??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "??", "?????", "?? ",
                               "????", "????", "????", "????", "??", "??", "????", "??", "????", "????", "????", "?????", "????", "????", "?????",
                               "?????", "??", "????", "?????", "????", "????", "??", "??", "????", "?????", "?????", "??", "??", "*");

        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
                            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
                            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "n", "N", "");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }
}
