<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends BackendController
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
        $data['departments']=Department::paginate(10);
        $data['breadcrumbs'] = [
            [
                'title' => 'Departments',
                'url' => 'departments',
            ]
        ];
        view()->share('page_title', 'All Departments');
        return view('departments.index',$data);
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
                'title' => 'Departments',
                'url' => 'departments',
            ]
        ];
        view()->share('page_title', 'New Department');
        return view('departments.modify',$data);
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
            'tax' => 'required',
        ];
        $this->validate($request, $rules);
        $department = new Department();
        $department->name = $request->input('name');
        $department->tax = $request->input('tax');
        $department->save();
        return redirect(url('departments'))->with('success', 'Your record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['department'] = Department::findOrFail($id);
        $data['breadcrumbs'] = [
            [
                'title' => 'Departments',
                'url' => 'departments',
            ]
        ];
        view()->share('page_title', 'Modify Department');
        return view('departments.modify',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:30',
            'tax' => 'required',
        ];
        $this->validate($request, $rules);
        $department = Department::findOrFail($id);
        $department->name = $request->input('name');
        $department->tax = $request->input('tax');
        $department->save();
        return redirect()->back()->with("success", "Your record has been update successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
}
