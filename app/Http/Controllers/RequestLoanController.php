<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Models\Priority;
use Illuminate\Http\Request;
use App\Models\RequestLoan;
use App\Http\Requests\RequestLoan\StoreRequest;

use App\Http\Requests\RequestLoan\UpdateRequest;
class RequestLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        $requestLoansPr1=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 1)->orderBy('priorities.name', 'asc');

        $requestLoansPr2=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 2)->orderBy('priorities.name', 'asc');

        $requestLoansPr3=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 3)->orderBy('priorities.name', 'asc');


        $requestLoanall=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                     orderBy('priorities.name', 'asc');


        $data=[
            'priorities'=>Priority::leftjoin('request_loans', 'priorities.id', '=', 'request_loans.priority_id')->
                          select('priorities.id', 'priorities.name')->
                          selectraw('(CASE WHEN  ISNULL( SUM(amountRequested)) THEN 0 ELSE SUM(amountRequested) END) as loan_sum')->
                          groupBy('priorities.id', 'priorities.name')->get(),

            'requestLoansPr1'=>$requestLoansPr1->get(),
            'requestLoansPr2'=>$requestLoansPr2->get(),
            'requestLoansPr3'=>$requestLoansPr3->get(),
            'requestLoansAll'=>$requestLoanall->get()

        ];
        return view('RequestLoan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AutorizeRequest $request)
    {
        $data=[
            'priorities'=>Priority::all()
        ];

        return view('RequestLoan.create', $data);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $arrRequestLoan=[
            'date'=>$request->date,
            'clientName'=>$request->clientName,
            'amountRequested'=>$request->amountRequested,
            'priority_id'=>$request->priority,
            'comments'=>$request->comments
        ];
        RequestLoan::create($arrRequestLoan);
        return redirect()->to(url('/requestLoan'))->with(['message'=>'Solicitud de prestamo creada correctamente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit ( AutorizeRequest $request, string $id)
    {
        $requestLoan=RequestLoan::find($id);
        $data=[
            'requestLoan'=>$requestLoan,
            'priorities'=>Priority::all()
        ];
        return view('RequestLoan.edit', $data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $requestLoan=RequestLoan::find($id);
        $arrRequestLoan=[
            'date'=>$request->date,
            'clientName'=>$request->clientName,
            'amountRequested'=>$request->amountRequested,
            'priority_id'=>$request->priority,
            'comments'=>$request->comments
        ];
        $requestLoan->update($arrRequestLoan);
        return redirect()->to(url('/requestLoan'))->with(['message'=>'Solicitud de prestamo actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, string $id)
    {
        $requestLoan=RequestLoan::find($id);
        $requestLoan->delete();
        return redirect()->to(url('/requestLoan'))->with(['message'=>'Solicitud de prestamo eliminada correctamente']);
        //
    }
}
