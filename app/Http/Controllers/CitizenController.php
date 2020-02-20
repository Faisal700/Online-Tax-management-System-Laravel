<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CitizenController extends BackendController
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
        $data['citizens']=User::where('role','Citizen')->paginate(15);
        $data['breadcrumbs'] = [
            [
                'title' => 'Citizens',
                'url' => 'citizens',
            ]
        ];
        view()->share('page_title', 'All Citizens');
        return view('citizens.index',$data);
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
                'title' => 'Citizens',
                'url' => 'citizens',
            ]
        ];
        view()->share('page_title', 'New Registration');
        return view('citizens.modify',$data);
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
            'name' => 'required|min:3|max:30',
            'email' => 'required|email',
            'password' => 'required',
        ];

        $this->validate($request, $rules);
        $user = new User();
        if ($request->hasFile('image')) {
            $filename = 'image-' . time() . rand(99, 199) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/uploads/' . 'citizens/', $filename);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        if (isset($filename))
            $user->image = url('/public/uploads/citizens/'.$filename)  ;
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();
        return redirect(url('citizens'))->with('success', 'Your record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['citizen'] = User::findOrFail($id);
        $data['breadcrumbs'] = [
            [
                'title' => 'Citizens',
                'url' => 'citizens',
            ]
        ];
        view()->share('page_title', 'Modify Registration');
        return view('citizens.modify',$data);
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
            'name' => 'required|min:3|max:30',
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        if ($request->hasFile('image')) {
            $filename = 'image-' . time() . rand(99, 199) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/uploads/' . 'citizens/', $filename);
            if (!empty($user->image)) {
                if (file_exists($user->image)){
                    unlink($user->image);
                }

            }
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->annual_income = $request->input('annual_income');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }
        if (isset($filename))
            $user->image = url('/public/uploads/citizens/'.$filename)  ;
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();
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
        $user = User::findOrFail($id);
        $file =public_path() .str_replace(url(''),"",$user->image);
        if (!empty($user->image)) {
            if (file_exists($file))
                unlink($file);
        }
        $user->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
}
