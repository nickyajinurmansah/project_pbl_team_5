<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonaturController extends Controller
{
    //
    public function index(){
        return view('donatur.index');

    }

    public function create()
    {
        return view('donatur.create');
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
