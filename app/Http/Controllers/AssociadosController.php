<?php

namespace App\Http\Controllers;

use App\Models\Explicacao;
use Illuminate\Http\Request;

class AssociadosController extends Controller
{
    public function index()
    {
        return view('associados');
    }
}
