<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Auth;
class PaymentController extends BackendController
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
        $data['payments']=Payment::all();
        $data['breadcrumbs'] = [
            [
                'title' => 'Payments',
                'url' => 'payments',
            ]
        ];
        view()->share('page_title', 'All Payments');
        return view('payments.index',$data);
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
                'title' => 'Payments',
                'url' => 'payments',
            ]
        ];
        view()->share('page_title', 'Add Payment');
        return view('payments.modify',$data);
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
            'type' => 'required',
            'date' => 'required',
        ];
        if($request->input('type')!='' && $request->input('type')=="Credit"){
            $rules['account_number']=  'required';
            $rules['amount']=  'required';
        }
        $this->validate($request, $rules);
        $payment = new Payment();
        $payment->citizen_id = Auth::user()->id;
        $payment->type = $request->input('type');
        $payment->account_number = $request->input('account_number');
        $payment->amount = $request->input('amount');
        $payment->date = $request->input('date');
        if($request->input('type')=="Credit"){
            $payment->status = 'Completed';
        }else{
            $payment->status = 'Pending';
        }
        if ($request->hasFile('payment_slip')) {
            $filename = 'file-' . time() . rand(99, 199) . '.' . $request->file('payment_slip')->getClientOriginalExtension();
            $request->file('payment_slip')->move(public_path() . '/uploads/' . 'files/', $filename);
        }
        if (isset($filename))
            $payment->payment_slip = url('/public/uploads/files/'.$filename)  ;
        $payment->save();
        return redirect(url('payments'))->with('success', 'Your record has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['payment'] = Payment::findOrFail($id);
        if(Auth::user()->role=="Admin"){
            if($data['payment']->seen==0)
            $data['payment']->seen=1;
            $data['payment']->save();
            $data['breadcrumbs'] = [
                [
                    'title' => 'Payments',
                    'url' => 'payments/all',
                ]
            ];
        }else{
            $data['payment']->seen=3;
            $data['payment']->save();
            $data['breadcrumbs'] = [
                [
                    'title' => 'Payments',
                    'url' => 'payments',
                ]
            ];
        }


        view()->share('page_title', 'View Payment Detail');
        return view('payments.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['payment'] = Payment::findOrFail($id);
        $data['breadcrumbs'] = [
            [
                'title' => 'Payments',
                'url' => 'payments',
            ]
        ];
        view()->share('page_title', 'Modify Payments');
        return view('payments.modify',$data);
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
            'type' => 'required',
            'date' => 'required',
        ];
        if($request->input('type')!='' && $request->input('type')=="Credit"){
            $rules['account_number']=  'required';
            $rules['amount']=  'required';
        }
        $this->validate($request, $rules);
        $payment = Payment::findOrFail($id);
        $payment->citizen_id = Auth::user()->id;
        $payment->type = $request->input('type');
        $payment->account_number = $request->input('account_number');
        $payment->amount = $request->input('amount');
        if($request->input('type')=="Credit"){
            $payment->status = 'Completed';
        }else{
            $payment->status = 'Pending';
        }
        $payment->date = $request->input('date');
        if ($request->hasFile('payment_slip')) {
            $filename = 'file-' . time() . rand(99, 199) . '.' . $request->file('payment_slip')->getClientOriginalExtension();
            $request->file('payment_slip')->move(public_path() . '/uploads/' . 'files/', $filename);
            if (!empty($payment->payment_slip)) {
                if (file_exists($payment->payment_slip))
                    unlink($payment->payment_slip);
            }
        }
        if (isset($filename))
            $payment->payment_slip = url('/public/uploads/files/'.$filename)  ;
        $payment->save();
        return redirect()->back()->with('success', 'Your record has been added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->back()->with("success", "Your record has been Deleted successfully.");
    }
    // All Payments
    public function Allpayment(Request $request){
        $data['citizens']=User::where('role','Citizen')->get();
        $data['payments']=Payment::where('citizen_id',$request->input('citizen'))->get();
        $data['breadcrumbs'] = [
            [
                'title' => 'All Payments',
                'url' => 'payments/all',
            ]
        ];
        view()->share('page_title', 'All Payments');
        return view('payments.all',$data);
    }
    // Confirmpayment
    public function Confirmpayment($id){
        $payment=Payment::where('id',$id)->first();
        $payment->status="Completed";
        $payment->seen=2;
        $payment->save();
        $data['breadcrumbs'] = [
            [
                'title' => 'All Payments',
                'url' => 'payments/all',
            ]
        ];
        view()->share('page_title', 'All Payments');
        return redirect()->back()->with("success", "Your record has been updated successfully.");
    }
    // Cancelmpayment
    public function Cancelpayment($id){
        $payment=Payment::where('id',$id)->first();
        $payment->status="Rejected";
        $payment->seen=2;
        $payment->save();
        $data['breadcrumbs'] = [
            [
                'title' => 'All Payments',
                'url' => 'payments/all',
            ]
        ];
        view()->share('page_title', 'All Payments');
        return redirect()->back()->with("success", "Your record has been updated successfully.");
    }
}
