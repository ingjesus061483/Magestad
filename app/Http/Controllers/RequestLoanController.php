<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Priority;
use Illuminate\Http\Request;
use App\Models\RequestLoan;
use App\Http\Requests\RequestLoan\StoreRequest;

use App\Http\Requests\RequestLoan\UpdateRequest;
use Illuminate\Database\Eloquent\Builder;

class RequestLoanController extends Controller
{
    protected Builder $requestLoansPr1;
    protected Builder $requestLoansPr2;
    protected Builder $requestLoansPr3;
    protected Builder $requestLoansAll;
    function __construct(    )
    {
        $this-> requestLoansPr1=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 1);

        $this-> requestLoansPr2=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 2);

        $this-> requestLoansPr3=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')->
                                      where('request_loans.priority_id', 3);

        $this-> requestLoansAll=RequestLoan::select('request_loans.*','priorities.name as priorityName')->join('priorities', 'request_loans.priority_id', '=', 'priorities.id')
                                          ->orderBy('priorities.name', 'asc');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
    $rows_per_page=$request->rows_per_page!=null?$request->rows_per_page: env('ROWS_PER_PAGE');
       $requestLoansPr1=$this->filterBy($request,$this->requestLoansPr1);
       $requestLoansPr2=$this->filterBy($request,$this->requestLoansPr2);
       $requestLoansPr3=$this->filterby($request,$this->requestLoansPr3);
       $requestLoansAll=$this->filterby($request,$this->requestLoansAll);
       $data=[
              'rows_per_page'=>$rows_per_page,
            'firstdate'=>$request->firstdate ? date('Y-m-d', strtotime($request->firstdate)) : null,
            'enddate'=>$request->enddate ? date('Y-m-d', strtotime($request->enddate)) : null,
            'client_name'=>$request->client,
            'client_id'=>$request->client_id,
            'priorities'=>Priority::leftjoin('request_loans', 'priorities.id', '=', 'request_loans.priority_id')->
                          select('priorities.id', 'priorities.name')->
                          selectraw('(CASE WHEN  ISNULL( SUM(amountRequested)) THEN 0 ELSE SUM(amountRequested) END) as loan_sum')->
                          groupBy('priorities.id', 'priorities.name')->get(),
            'requestLoansPr1'=>$requestLoansPr1->paginate($rows_per_page),
            'requestLoansPr2'=>$requestLoansPr2->paginate($rows_per_page),
            'requestLoansPr3'=>$requestLoansPr3->paginate($rows_per_page),
            'requestLoansAll'=>$requestLoansAll->paginate($rows_per_page)

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
            'client_id'=>$request->client_id,
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
    public function edit ( AutorizeRequest $request, int $id)
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
    public function update(UpdateRequest $request, int $id)
    {
        $requestLoan=RequestLoan::find($id);
        $arrRequestLoan=[
            'date'=>$request->date,
            'client_id'=>$request->client_id,
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
    public function destroy(AutorizeRequest $request, int $id)
    {
        $requestLoan=RequestLoan::find($id);
        $requestLoan->delete();
        return redirect()->to(url('/requestLoan'))->with(['message'=>'Solicitud de prestamo eliminada correctamente']);
        //
    }
}
