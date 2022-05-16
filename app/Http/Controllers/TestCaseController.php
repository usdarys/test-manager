<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestCaseRequest;
use App\Models\TestCase;
use Illuminate\Http\Request;

class TestCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $testCaseList = TestCase::all(['id', 'name']);
        return view('test-case-list', [
            'testCaseList' => $testCaseList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test-case');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestCaseRequest $request)
    {
        $testCase = new TestCase();
        $testCase->name = $request->name;
        $testCase->preconditions = $request->preconditions;
        $testCase->steps = $request->steps;
        $testCase->expected_result = $request->expected_result;
        $testCase->save();

        return redirect()->route('test-case.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
