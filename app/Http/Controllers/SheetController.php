<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Sheet\SheetResolver;
use App\StudentDetail;

use SendGrid\Mail\Mail as SendGridMail;


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

    public function email(Request $request)
    {
        $frm = $request->input('frm');
        $content = $request->input('content');

        try{
            $email = new SendGridMail;
            $email->setFrom($frm, 'Test');
            $email->setSubject('Request more Info');
            $email->addTo('imakhilravindran@gmail.com', 'Akhil Ravindran');
            $email->addDynamicTemplateData('content',$content);
            $email->setTemplateId('d-a518ed897c614219869c9dad6181d4d5');

            $sendgrid = new \SendGrid('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');
            $response = $sendgrid->send($email);
            return response()->json('Email is sended', $response->statusCode());
        }
        catch (\Exception $e){
            return response()->json('Email was not send', 500 );
        }


//        // $to = "govind_kartha@ieee.org";
//        $to = "govkartha@gmail.com";
//        $subject = "Request more Info";
//        $headers = "From: [$frm]" . "\r\n" . "CC: sjaykh@ieee.org";
//
//        mail($to,$subject,$content,$headers);
//        return response()->json(['response'=>'success']);

    }
}
