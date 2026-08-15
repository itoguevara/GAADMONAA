<?php

namespace app\Http\Controllers\generic;

use app\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\View\View;
use Illuminate\Http\Request;
use PublicFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class genericctrl extends Controller
{
    //
        public function show(int $opcionvar)
    {
      session()->put('id_page_show', $opcionvar);
       // dump('Hola 01',get_defined_vars(),$opcionvar,session(['id_page_show']));
      $message = 'Inicio Exitoso';
     return view('home', compact('opcionvar'))->with($opcionvar);
     
     // return redirect()->route('home', [$opcionvar]);
     //return redirect()->route('home', compact('opcionvar'))->with('opcionvar', $opcionvar);;
     //return redirect()->route('home')->with('opcionvar', $opcionvar);;

    }
}
