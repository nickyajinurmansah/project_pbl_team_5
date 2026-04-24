<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    //Tampilan halaman index
    public function create()
    {
        return view('pengurus.create');
    }

    public function store(){
        $request->validate([
       
        ]);
    }

   public function show(){ }

   public function edit(){

    }

 
    public function update(){ }
    public function destroy(){ }

}
