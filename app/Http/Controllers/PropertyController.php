<?php

namespace App\Http\Controllers;

use App\BasicUnit;
use App\Department;
use App\Property;
use App\PropertyDepartment;
use Illuminate\Http\Request;
use Auth;
class PropertyController extends BackendController
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
        $data['properties']=Property::where('user_id',Auth::user()->id)->get();
        $data['breadcrumbs'] = [
            [
                'title' => 'Properties',
                'url' => 'properties',
            ]
        ];
        view()->share('page_title', 'All Properties');
        return view('properties.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['property_areas']=BasicUnit::all();
        $data['departments']=Department::all();
        $data['breadcrumbs'] = [
            [
                'title' => 'Properties',
                'url' => 'properties',
            ]
        ];
        view()->share('page_title', 'New Property');
        return view('properties.modify',$data);
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
            'marla' => 'required',
            'property_area' => 'required',
            'house_no' => 'required',
            'address' => 'required',
        ];
        $this->validate($request, $rules);
        $property = new Property();
        if(Auth::user()->role=="Citizen"){
            $property->user_id = Auth::user()->id;
        }

        $property->property_area_id = $request->input('property_area');
        $property->marla = $request->input('marla');
        $property->type = $request->input('type');
        $property->house_no = $request->input('house_no');
        $property->address = $request->input('address');
        $property->save();
        // Department in property added
        if(count($request->input('departments'))>0){
            foreach ($request->input('departments') as $sale_area){
                $dep_pro = new PropertyDepartment();
                $dep_pro->department_id = $sale_area;
                $dep_pro->property_id = $property->id;
                $dep_pro->save();
            }
        }
        return redirect(url('properties'))->with('success', 'Your record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['property'] = Property::findOrFail($id);
        $data['departments']=Department::all();
        $data['pro_dept'] = PropertyDepartment::where('property_id',$id)->get();
        $data['property_areas']=BasicUnit::all();
        $data['breadcrumbs'] = [
            [
                'title' => 'Properties',
                'url' => 'properties',
            ]
        ];
        view()->share('page_title', 'Modify Property');
        return view('properties.modify',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'marla' => 'required',
            'property_area' => 'required',
            'house_no' => 'required',
            'address' => 'required',
        ];
        $this->validate($request, $rules);
        $property = Property::findOrFail($id);
        if(Auth::user()->role=="Citizen"){
            $property->user_id = Auth::user()->id;
        }
        $property->property_area_id = $request->input('property_area');
        $property->marla = $request->input('marla');
        $property->type = $request->input('type');
        $property->house_no = $request->input('house_no');
        $property->address = $request->input('address');
        $property->save();
        // Department in property added
       PropertyDepartment::where('property_id',$property->id)->delete();
        if(count($request->input('departments'))>0){
            foreach ($request->input('departments') as $sale_area){
                $dep_pro = new PropertyDepartment();
                $dep_pro->department_id = $sale_area;
                $dep_pro->property_id = $property->id;
                $dep_pro->save();
            }
        }
        return redirect()->back()->with("success", "Your record has been update successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
    //All Property
    public function AllProperty(Request $request){
        $data['properties']=Property::all();
        $data['breadcrumbs'] = [
            [
                'title' => 'Properties',
                'url' => 'properties',
            ]
        ];
        view()->share('page_title', 'All Properties');
        return view('properties.all',$data);
    }
}
