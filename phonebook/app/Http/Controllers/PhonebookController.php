<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Excel;
use Excel;
//For access User Auth Controller class 
use Illuminate\Support\Facades\Auth;
use App\Phonebook;
use DB;
class PhonebookController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
		$testing = 'testing for share methode';
		
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
	    $userId = Auth::user()->id;
		
        $phonebooks= Phonebook::where('user_id', $userId)->orderBy('id','DESC')->paginate(20);
        return view('phonebooks.index',compact('phonebooks'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phonebooks.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
        ]);
        Phonebook::create($request->all());
        return redirect()->route('phonebooks.index')
                        ->with('success','Phonebook has created successfully');
						
		// return $request->all();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
	    
        $phonebook = Phonebook::find($id);
		//$product = Product::find($id)->where('id', 5)->get();
		//return $product;
        return view('phonebooks.show',compact('phonebook'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phonebook= Phonebook::find($id);
        return view('phonebooks.edit',compact('phonebook'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
        ]);
        Phonebook::find($id)->update($request->all());
        return redirect()->route('phonebooks.index')
                        ->with('success','PhoneBook updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
		if (is_array($id)) 
		{
			Phonebook::findOrFail($id)->delete();
			return redirect()->route('phonebooks.index')
		                 ->with('success','PhoneBook deleted successfully');
		}
		else
		{
			Phonebook::findOrFail($id)->delete();
			return redirect()->route('phonebooks.index')
							 ->with('success','PhoneBook deleted successfully');
		}
        
    }
	
	 public function deleteAll(Request $request)
		{
        $ids = $request->ids;
        DB::table("phonebooks")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"phonebooks Deleted successfully."]);
		}
	
	public function search(Request $request){
	    $userId = Auth::user()->id;
	    $searchString = $request->searchString;
		//var_dump($searchString);
		//var_dump($request);
		$order_by = $request->order_by;
		$order = $request->order;
		
		if(Auth::user()->type =='admin'){
			$phonebooks= Phonebook::where('name', 'like', '%' . $searchString . '%')->orderBy($order_by,$order)->paginate(20);	
		}
		else{
		$phonebooks= Phonebook::where('user_id', $userId)->where('name', 'like', '%' . $searchString . '%')->orderBy($order_by,$order)->paginate(20);
		}
        return view('phonebooks.index',compact('phonebooks'))
            ->with('i', ($request->input('page', 1) - 1) * 20)
			->with('user_search_string', $searchString )
			->with('order_by', $order_by )
			->with('order', $order );
		
		
	}
	
	public function exportphonebook(){
		$userId = Auth::user()->id;
		if(Auth::user()->type =='admin'){
			$data = Phonebook::get()->toArray();
		}
		else{
			$data = Phonebook::get()->where('user_id', $userId)->toArray();
		}
		
		
		Excel::create('contact_list', function($excel) use($data) {

			$excel->sheet('Sheetname', function($sheet) use($data) {

				$sheet->fromArray($data);

			});

		})->export('csv');
							
	}
}