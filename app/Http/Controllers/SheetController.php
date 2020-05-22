<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Sheet\SheetResolver;

class SheetController extends Controller
{

    public function __construct(SheetResolver $resolver){
        $this->resolver = $resolver;
    }

    public function resolve(Request $request){
        // $path = $request->file('sheet')->store('public/sheets');
        // $path = substr(Storage::url($path), 1);
        // die($path);
        $this->resolver->putToDatabase('storage/sheets/7nR32MjFFwB6XPalDNgZnv4HLTdWcYcT5kSD7Oyd.xlsx');
        
    }
}