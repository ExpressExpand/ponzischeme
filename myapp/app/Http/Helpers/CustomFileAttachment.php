<?php
namespace App\Http\Helpers;

use App\Http\Helper;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\MyCustomException;

/**
* @author FAMUREWA TAIWO EZEKIEL
* @copyright 2016
* @example This class should be wrapped in a try catch method to work properly
*/
class CustomFileAttachment {
	/** 
	* @author FAMUREWA TAIWO EZEKIEL
	* @param THIS ACCEPTS A REQUEST OBJECT
	* @return this returns an array of a string filename and imagepath
	*/ 
	public static function uploadAttachment(Request $request, $page=null) {
        if(!$request->hasFile('attachment')){
            throw new MyCustomException("Uploading an image is compulsory", 1);
            
        }
		$valid_ext= array('doc', 'docx', 'pdf',
			'application/msword',
			'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/pdf',
            'image/jpeg',
            'image/jpg', 'image/png', 'image/gif');
        $file = $request->file('attachment');
        $filename = $file->getClientOriginalName();
    	$mime_type =$file->getMimeType();
        //check for mime type
        if(!in_array($mime_type, $valid_ext)){ 
            $errors = 'You can only upload .doc, .docx, .pdf, .jpg, .png and a .jpeg file extensions';
            throw new MyCustomException($errors); 
        }
        
        //check for the fileszie
        if($file->getSize() >  500000){ 
            $errors = 'Maximum size for uploads is 500kb';
            throw new MyCustomException($errors); 
        }

        // $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        //$filename = time()."-".$file->getClientOriginalName();
        $filehash = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
        if($page == null) {
            $page = 'proofs';
        }
        $image = $file->move(public_path()."/images/".$page."/", $filehash);
        return array($filename, $filehash);	
	}
}