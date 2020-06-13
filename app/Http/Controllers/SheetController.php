<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Sheet\SheetResolver;
use App\StudentDetail;


class SheetController extends Controller
{

    public function __construct(SheetResolver $resolver){
        $this->resolver = $resolver;
    }

    public function resolve(Request $request){
        $path = $request->file('sheet')->store('public/sheets');
        $path = substr(Storage::url($path), 1);

        $this->resolver->putToDatabase($path);

        return response()->json(['success' => 'success'], 200);
    }

    public function index(){
        $users = StudentDetail::all();

        if($users == NULL){
            return response()->json(['response'=>'error']);
        }
        else{
            return response()->json($users,200);
        }
    }

    public function search_id($member_id){
        $users = StudentDetail::where('member_id', $member_id)->first();
        if($users == NULL){
            return response()->json(['response'=>'error : Member not found']);
        }
        else{
            return response()->json($users,200);
        }
    }

    public function search_name($name){
        $users = StudentDetail::where('first_name',"LIKE", "%{$name}%")->get();
        if($users == NULL){
            return response()->json(['response'=>'error : Member not found']);
        }
        else{
            return response()->json($users,200);
        }
    }

    public function show_category($cat){
        $users = StudentDetail::where('renewal_category', $cat)->get();

        if($users == NULL){
            return response()->json(['response'=>'error']);
        }
        else{
            return response()->json($users,200);
        }
    }

    public function email(Request $request){
        $frm = $request->input('frm');
        $content = $request->input('content');
        // $to = "govind_kartha@ieee.org";
        $to = "govkartha@gmail.com";
        $subject = "Request more Info";
        $headers = "From: [$frm]" . "\r\n" . "CC: sjaykh@ieee.org";

        mail($to,$subject,$content,$headers);
        return response()->json(['response'=>'success']);

    }
}
