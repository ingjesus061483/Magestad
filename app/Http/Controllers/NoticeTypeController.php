<?php

namespace App\Http\Controllers;

use App\Models\NoticeType;
use App\Http\Requests\StoreNoticeTypeRequest;
use App\Http\Requests\UpdateNoticeTypeRequest;

class NoticeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $noticetypes=NoticeType::paginate(env('ROWS_PER_PAGE'));
        $data=[
            'noticestypes'=>$noticetypes
        ];
        return view('NoticeType.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NoticeType $noticeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NoticeType $noticeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeTypeRequest $request, NoticeType $noticeType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoticeType $noticeType)
    {
        //
    }
}
