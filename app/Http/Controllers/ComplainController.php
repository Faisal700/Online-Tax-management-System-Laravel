<?php

namespace App\Http\Controllers;

use App\Complain;
use Illuminate\Http\Request;
use Auth;
class ComplainController extends BackendController
{
    public function __construct()
    {
        parent::__construct(  );
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['complains']=Complain::where('user_id',Auth::user()->id)->paginate(10);
        $data['breadcrumbs'] = [
            [
                'title' => 'Complains',
                'url' => 'complains',
            ]
        ];
        view()->share('page_title', 'All Complains');
        return view('complains.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumbs'] = [
            [
                'title' => 'Complains',
                'url' => 'complains',
            ]
        ];
        view()->share('page_title', 'New Complain');
        return view('complains.modify',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'complain' => 'required',
        ];
        $this->validate($request, $rules);
        $complain = new Complain();
        $complain->user_id = Auth::user()->id;
        $complain->complain = $request->input('complain');
        $complain->save();
        return redirect(url('complains'))->with('success', 'Your record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['complain'] = Complain::findOrFail($id);
        if(Auth::user()->role=="Admin"){
            if($data['complain']->seen==0)
            $data['complain']->seen=1;
            $data['complain']->save();
            $data['breadcrumbs'] = [
                [
                    'title' => 'Complains',
                    'url' => 'complains/all',
                ]
            ];
        }else{
            $data['complain']->seen=3;
            $data['complain']->save();
            $data['breadcrumbs'] = [
                [
                    'title' => 'Complains',
                    'url' => 'complains/all',
                ]
            ];
        }
        view()->share('page_title', 'View Complain Detail');
        return view('complains.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['complain'] = Complain::findOrFail($id);
        $data['breadcrumbs'] = [
            [
                'title' => 'Complains',
                'url' => 'complains',
            ]
        ];
        view()->share('page_title', 'Modify Complain');
        return view('complains.modify',$data);
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
        $rules = [
            'complain' => 'required',
        ];
        $this->validate($request, $rules);
        $complain = Complain::findOrFail($id);
        $complain->user_id = Auth::user()->id;
        $complain->complain = $request->input('complain');
        $complain->save();
        return redirect()->back()->with("success", "Your record has been update successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complain = Complain::findOrFail($id);
        $complain->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
    //AllComplain
    public function AllComplain(){
        $data['complains']=Complain::paginate(10);
        $data['breadcrumbs'] = [
            [
                'title' => 'All Complains',
                'url' => 'complains/all',
            ]
        ];
        view()->share('page_title', 'All Complains');
        return view('complains.all',$data);
    }
    //response
    public function Response(Request $request,$id){

        $complain = Complain::findOrFail($id);
        $complain->response = $request->input('response');
        $complain->status = true;
        $complain->seen = 2;
        $complain->save();
        return redirect()->back()->with("success", "Your record has been update successfully.");
    }
}
