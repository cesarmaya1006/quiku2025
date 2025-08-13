<?php

namespace App\Http\Controllers\Extranet;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tipo_Docu;
use Illuminate\Http\Request;

class ExtranetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('extranet.login.index');
    }

    public function registro_ini()
    {
        $tipos_docu = Tipo_Docu::get();
        return view('extranet.registro.registro_ini', compact('tipos_docu'));
    }

    public function correo()
    {
        return view('extranet.login.correo');
    }


    public function registro_ini_guardar(ValidarRegistroIni $request)
    {
        $usuarioTemp = UsuarioTemp::create($request->all());
        $id = $usuarioTemp->id;
        $tipopersona = $usuarioTemp->tipo_persona;
        $cedula = $usuarioTemp->identificacion;
        $email = $usuarioTemp->email;
        // -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
        //produccion Pruebas
        //$headers =  'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'From: Your name <info@address.com>' . "\r\n";
        //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$mensaje = $this->mensajeRegistroinicial($id, $tipopersona, $cedula);
        //$para = 'jgmedina73@gmail.com';
        //$titulo = 'Registro plataforma Quiku';
        //mail($para, $titulo, $mensaje, $headers);
        // -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
        // Desarrollo
        Mail::to($email)->send(new RegistroInicial($id, $tipopersona, $cedula));
        return redirect('/registro_conf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
