<?php
 
namespace App\Helpers;

class apihelpers {

    public static function createapiresponse($is_error, $message, $content){
        $result = [];

        if($is_error){
            $result['success'] = FALSE;
            $result['message'] = $message;
        }
        else{
            $result['success'] = TRUE;
            $result['message'] = $message; 
            if($content == NULL){
                $result['message'] = $message;
            }
            else{
                $result['data'] = $content;
            }
        }
        return $result;
    }
}