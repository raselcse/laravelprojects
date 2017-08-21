<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
//For access User Auth Controller class 
use Illuminate\Support\Facades\Auth;
use App\Phonebook;
use App\Classes\VCard;
class UploadController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
	    return view('phonebooks.upload');
    }
	
	function csvToArray($filename = '', $delimiter = ','){
			if (!file_exists($filename) || !is_readable($filename))
				return false;

			$header = null;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== false)
			{
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
				{
					if (!$header)
						$header = $row;
					else
						$data[] = array_combine($header, $row);
				}
				fclose($handle);
			}

			return $data;
	}
   public function store(Request $request)
	{
		if($request->hasFile('contact_upload')) {
			//$path = $request->file('contact_upload')->path();
            $file = $request->file('contact_upload');
			$userId = Auth::user()->id;
			$destinationPath = 'uploads/'.$userId.'/';
			$file->move($destinationPath,$file->getClientOriginalName());
		
		
			$file = public_path($destinationPath.'/'.$file->getClientOriginalName());

			$customerArr = $this->csvToArray($file);
		
			for ($i = 0; $i < count($customerArr); $i ++){
				
				$user = Phonebook::create([
						'user_id' => Auth::user()->id,
						'name' => $customerArr[$i]['Display Name'],
						'email' => $customerArr[$i]['E-mail Address'],
						'mobile' => $customerArr[$i]['Mobile Phone'],
						// other fields
						]);
			    
			}
			
			return redirect()->route('phonebooks.index')
                        ->with('success','Your All contact has been successfully save');

		}
	}
	
	public function signatureUpload(Request $request){

        $userId = Auth::user()->id;
		$data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $sig = "../storage/app/uploads/".$userId."_signatureImage.png";
        $contents = file_put_contents($sig, $decoded_image);
	}

}