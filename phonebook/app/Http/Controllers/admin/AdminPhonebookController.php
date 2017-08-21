<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//For access User Auth Controller class 
use Illuminate\Support\Facades\Auth;
use App\Phonebook;
class AdminPhonebookController extends Controller
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
	    
		$phonebooks = \App\Phonebook::paginate(20);
        return view('admin.phonebooks.index',compact('phonebooks'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.phonebooks.create');
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
                        ->with('success','Product created successfully');
						
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
        return view('admin.phonebooks.show',compact('phonebook'));
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
        return view('admin.phonebooks.edit',compact('phonebook'));
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
        return redirect()->route('admin.phonebooks.index')
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
        Phonebook::find($id)->delete();
        return redirect()->route('admin.phonebooks.index')
                        ->with('success','PhoneBook deleted successfully');
    }
	
	public function search(Request $request){
	    $userId = Auth::user()->id;
	    $searchString = $request->searchString;
		//var_dump( $searchString);
		$products= Phonebook::all()->where('name', 'like', '%' . $searchString . '%')->orderBy('id','DESC')->paginate(20);
        return view('admin.phonebooks.index',compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
	}
}