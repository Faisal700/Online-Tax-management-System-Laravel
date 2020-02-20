<?php

namespace App\Http\Controllers;

use App\BasicUnit;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use Auth;
class BasicUnitController extends BackendController
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
        $data['basic_units']=BasicUnit::all();
        $data['breadcrumbs'] = [
            [
                'title' => 'Basic Units',
                'url' => 'basic_units',
            ]
        ];
        view()->share('page_title', 'All Basic Units');
        return view('basic_units.index',$data);
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
                'title' => 'Basic Units',
                'url' => 'basic_units',
            ]
        ];
        view()->share('page_title', 'Add Basic Unit');
        return view('basic_units.modify',$data);
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
            'unit' => 'required',
        ];
        $this->validate($request, $rules);
        $basic_unit = new BasicUnit();
        $basic_unit->name = $request->input('name');
        $basic_unit->unit = $request->input('unit');
        $basic_unit->save();
        return redirect(url('basic_units'))->with('success', 'Your record has been added successfully.');
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
        $data['basic_unit'] = BasicUnit::findOrFail($id);
        $data['breadcrumbs'] = [
            [
                'title' => 'Basic Units',
                'url' => 'basic_units',
            ]
        ];
        view()->share('page_title', 'Modify Basic Unit');
        return view('basic_units.modify',$data);
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
            'unit' => 'required',
        ];
        $this->validate($request, $rules);
        $basic_unit = BasicUnit::findOrFail($id);
        $basic_unit->unit = $request->input('unit');
        $basic_unit->save();
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
        $basic_unit = BasicUnit::findOrFail($id);
        $basic_unit->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
    //Tax Scale
    public function TaxScale(){
        $data['breadcrumbs'] = [
            [
                'title' => 'Tax Scale',
                'url' => 'tax_scale',
            ]
        ];
        view()->share('page_title', 'Tax Scale');
        return view('basic_units.tax_scale',$data);
    }
    //tax Calculate
    public function taxCalculate(){
        $properties=Property::where('user_id',Auth::user()->id)->with(['user','area'])->get();
        $income_tax=0;
        Switch(Auth::user()->type){
            case 'Business Man':
                if(Auth::user()->annual_income>400000)
                    $income_tax=(Auth::user()->annual_income) *(20/100) ;
                break;
            case 'Job Holder':
                if(Auth::user()->annual_income>200000)
                    $income_tax=(Auth::user()->annual_income) *(15/100) ;
                break;
            case 'Labour':
                if(Auth::user()->annual_income>100000)
                    $income_tax=(Auth::user()->annual_income) *(10/100) ;
                break;
        }
        $tax=[];
        $a=0;
        $total_tax=$income_tax;
        if(count($properties)>0){
            foreach ($properties as $property){
                switch ($property['property_area_id']){
                    case 1:
                      if($property['marla']=="less than 10"){
                          $tax[$a]['area']=$property->area->name;
                          $tax[$a]['house_no']=$property['house_no'];
                          $tax[$a]['type']=$property['type'];
                          $depart='';
                          $depart_tax=0;
                          if(isset($property->departments)){
                             foreach($property->departments as $dep){
                                 $depart=$depart.$dep->department->name.',';
                                 $depart_tax=$depart_tax+$dep->department->tax;
                             }
                          }
                          $tax[$a]['departments']=$depart;
                          $tax[$a]['marla']=$property['marla'];
                          $tax[$a]['tax']=($property->area->unit * $property->area->unit)+$depart_tax;
                          $a=$a+1;
                          $total_tax=$total_tax+($property->area->unit * $property->area->unit);
                      }elseif ($property['marla']=="10 to 20" && $property['type']=="rent"){
                          $tax[$a]['area']=$property->area->name;
                          $tax[$a]['house_no']=$property['house_no'];
                          $tax[$a]['type']=$property['type'];
                          $depart='';
                          $depart_tax=0;
                          if(isset($property->departments)){
                              foreach($property->departments as $dep){
                                  $depart=$depart.$dep->department->name.',';
                                  $depart_tax=$depart_tax+$dep->department->tax;
                              }
                          }
                          $tax[$a]['departments']=$depart;
                          $tax[$a]['marla']=$property['marla'];
                          $tax[$a]['tax']=($property->area->unit * 200)+$depart_tax;
                          $a=$a+1;
                          $total_tax=$total_tax+($property->area->unit * 200);
                      }elseif ($property['marla']=="10 to 20" && $property['type']=="self"){
                          $tax[$a]['area']=$property->area->name;
                          $tax[$a]['house_no']=$property['house_no'];
                          $tax[$a]['type']=$property['type'];
                          $depart='';
                          $depart_tax=0;
                          if(isset($property->departments)){
                              foreach($property->departments as $dep){
                                  $depart=$depart.$dep->department->name.',';
                                  $depart_tax=$depart_tax+$dep->department->tax;
                              }
                          }
                          $tax[$a]['departments']=$depart;
                          $tax[$a]['marla']=$property['marla'];
                          $tax[$a]['tax']=($property->area->unit * 100)+$depart_tax;
                          $a=$a+1;
                          $total_tax=$total_tax+($property->area->unit * 100);
                      }elseif ($property['marla']=="greater than 20" && $property['type']=="rent"){
                          $tax[$a]['area']=$property->area->name;
                          $tax[$a]['house_no']=$property['house_no'];
                          $tax[$a]['type']=$property['type'];
                          $depart='';
                          $depart_tax=0;
                          if(isset($property->departments)){
                              foreach($property->departments as $dep){
                                  $depart=$depart.$dep->department->name.',';
                                  $depart_tax=$depart_tax+$dep->department->tax;
                              }
                          }
                          $tax[$a]['departments']=$depart;
                          $tax[$a]['marla']=$property['marla'];
                          $tax[$a]['tax']=($property->area->unit * 500)+$depart_tax;
                          $a=$a+1;
                          $total_tax=$total_tax+($property->area->unit * 500);
                      }elseif ($property['marla']=="greater than 20" && $property['type']=="self"){
                          $tax[$a]['area']=$property->area->name;
                          $tax[$a]['house_no']=$property['house_no'];
                          $tax[$a]['type']=$property['type'];
                          $depart='';
                          $depart_tax=0;
                          if(isset($property->departments)){
                              foreach($property->departments as $dep){
                                  $depart=$depart.$dep->department->name.',';
                                  $depart_tax=$depart_tax+$dep->department->tax;
                              }
                          }
                          $tax[$a]['departments']=$depart;
                          $tax[$a]['marla']=$property['marla'];
                          $tax[$a]['tax']=($property->area->unit * 400)+$depart_tax;
                          $a=$a+1;
                          $total_tax=$total_tax+($property->area->unit * 400);
                      }
                        break;
                    case 2:
                        if($property['marla']=="less than 10"){
                            $tax[$a]['area']=$property->area->name;
                            $tax[$a]['house_no']=$property['house_no'];
                            $tax[$a]['type']=$property['type'];
                            $depart='';
                            $depart_tax=0;
                            if(isset($property->departments)){
                                foreach($property->departments as $dep){
                                    $depart=$depart.$dep->department->name.',';
                                    $depart_tax=$depart_tax+$dep->department->tax;
                                }
                            }
                            $tax[$a]['departments']=$depart;
                            $tax[$a]['marla']=$property['marla'];
                            $tax[$a]['tax']=(($property->area->unit * $property->area->unit)*2)+$depart_tax;
                            $a=$a+1;
                            $total_tax=$total_tax+(($property->area->unit * $property->area->unit)*2);
                        }elseif ($property['marla']=="10 to 20" && $property['type']=="rent"){
                            $tax[$a]['area']=$property->area->name;
                            $tax[$a]['house_no']=$property['house_no'];
                            $tax[$a]['type']=$property['type'];
                            $depart='';
                            $depart_tax=0;
                            if(isset($property->departments)){
                                foreach($property->departments as $dep){
                                    $depart=$depart.$dep->department->name.',';
                                    $depart_tax=$depart_tax+$dep->department->tax;
                                }
                            }
                            $tax[$a]['departments']=$depart;
                            $tax[$a]['marla']=$property['marla'];
                            $tax[$a]['tax']=(($property->area->unit * 200)*2)+$depart_tax;
                            $a=$a+1;
                            $total_tax=$total_tax+(($property->area->unit * 200)*2);
                        }elseif ($property['marla']=="10 to 20" && $property['type']=="self"){
                            $tax[$a]['area']=$property->area->name;
                            $tax[$a]['house_no']=$property['house_no'];
                            $tax[$a]['type']=$property['type'];
                            $depart='';
                            $depart_tax=0;
                            if(isset($property->departments)){
                                foreach($property->departments as $dep){
                                    $depart=$depart.$dep->department->name.',';
                                    $depart_tax=$depart_tax+$dep->department->tax;
                                }
                            }
                            $tax[$a]['departments']=$depart;
                            $tax[$a]['marla']=$property['marla'];
                            $tax[$a]['tax']=(($property->area->unit * 100)*2)+$depart_tax;
                            $a=$a+1;
                            $total_tax=$total_tax+(($property->area->unit * 100)*2);
                        }elseif ($property['marla']=="greater than 20" && $property['type']=="rent"){
                            $tax[$a]['area']=$property->area->name;
                            $tax[$a]['house_no']=$property['house_no'];
                            $tax[$a]['type']=$property['type'];
                            $depart='';
                            $depart_tax=0;
                            if(isset($property->departments)){
                                foreach($property->departments as $dep){
                                    $depart=$depart.$dep->department->name.',';
                                    $depart_tax=$depart_tax+$dep->department->tax;
                                }
                            }
                            $tax[$a]['departments']=$depart;
                            $tax[$a]['marla']=$property['marla'];
                            $tax[$a]['tax']=(($property->area->unit * 500)*2)+$depart_tax;
                            $a=$a+1;
                            $total_tax=$total_tax+(($property->area->unit * 500)*2);
                        }elseif ($property['marla']=="greater than 20" && $property['type']=="self"){
                            $tax[$a]['area']=$property->area->name;
                            $tax[$a]['house_no']=$property['house_no'];
                            $tax[$a]['type']=$property['type'];
                            $depart='';
                            $depart_tax=0;
                            if(isset($property->departments)){
                                foreach($property->departments as $dep){
                                    $depart=$depart.$dep->department->name.',';
                                    $depart_tax=$depart_tax+$dep->department->tax;
                                }
                            }
                            $tax[$a]['departments']=$depart;
                            $tax[$a]['marla']=$property['marla'];
                            $tax[$a]['tax']=(($property->area->unit * 400)*2)+$depart_tax;
                            $a=$a+1;
                            $total_tax=$total_tax+(($property->area->unit * 400)*2);
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        $data['all_tax']=$tax;
        $data['total_tax']=$total_tax;
        $data['breadcrumbs'] = [
            [
                'title' => 'tax Calculate',
                'url' => 'tax_calculate',
            ]
        ];
        view()->share('page_title', 'tax Calculate');
        return view('basic_units.tax_calculate',$data);
    }
    // tax Report
    public function taxReport(Request $request){
        $tax=[];
        $a=0;
        $total_tax=0;
        $income_tax=0;
        if ($request->citizen != '') {
            $properties=Property::where('user_id',$request->citizen)->with(['user','area'])->get();

            $user=User::where('id',$request->citizen)->first();
            Switch($user->type){
                case 'Business Man':
                    if($user->annual_income>400000)
                        $income_tax=($user->annual_income) *(20/100) ;
                    break;
                case 'Job Holder':
                    if($user->annual_income>200000)
                        $income_tax=($user->annual_income) *(15/100) ;
                    break;
                case 'Labour':
                    if($user->annual_income>100000)
                        $income_tax=($user->annual_income) *(10/100) ;
                    break;
            }
            if(count($properties)>0){
                foreach ($properties as $property){
                    switch ($property['property_area_id']){
                        case 1:
                            if($property['marla']=="less than 10"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=($property->area->unit * $property->area->unit)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+($property->area->unit * $property->area->unit);
                            }elseif ($property['marla']=="10 to 20" && $property['type']=="rent"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=($property->area->unit * 200)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+($property->area->unit * 200);
                            }elseif ($property['marla']=="10 to 20" && $property['type']=="self"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=($property->area->unit * 100)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+($property->area->unit * 100);
                            }elseif ($property['marla']=="greater than 20" && $property['type']=="rent"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=($property->area->unit * 500)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+($property->area->unit * 500);
                            }elseif ($property['marla']=="greater than 20" && $property['type']=="self"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=($property->area->unit * 400)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+($property->area->unit * 400);
                            }
                            break;
                        case 2:
                            if($property['marla']=="less than 10"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=(($property->area->unit * $property->area->unit)*2)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+(($property->area->unit * $property->area->unit)*2);
                            }elseif ($property['marla']=="10 to 20" && $property['type']=="rent"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=(($property->area->unit * 200)*2)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+(($property->area->unit * 200)*2);
                            }elseif ($property['marla']=="10 to 20" && $property['type']=="self"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=(($property->area->unit * 100)*2)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+(($property->area->unit * 100)*2);
                            }elseif ($property['marla']=="greater than 20" && $property['type']=="rent"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=(($property->area->unit * 500)*2)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+(($property->area->unit * 500)*2);
                            }elseif ($property['marla']=="greater than 20" && $property['type']=="self"){
                                $tax[$a]['area']=$property->area->name;
                                $tax[$a]['house_no']=$property['house_no'];
                                $tax[$a]['type']=$property['type'];
                                $depart='';
                                $depart_tax=0;
                                if(isset($property->departments)){
                                    foreach($property->departments as $dep){
                                        $depart=$depart.$dep->department->name.',';
                                        $depart_tax=$depart_tax+$dep->department->tax;
                                    }
                                }
                                $tax[$a]['departments']=$depart;
                                $tax[$a]['marla']=$property['marla'];
                                $tax[$a]['tax']=(($property->area->unit * 400)*2)+$depart_tax;
                                $a=$a+1;
                                $total_tax=$total_tax+(($property->area->unit * 400)*2);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }

        }
        $data['citizens']=User::where('role','Citizen')->get();
        $data['reports']=$tax;
        $data['total_tax']=$total_tax;
        $data['breadcrumbs'] = [
            [
                'title' => 'Taxation Report',
                'url' => 'tax_report',
            ]
        ];
        view()->share('page_title', 'Taxation Report');
        return view('basic_units.tax_report',$data);
    }
}
