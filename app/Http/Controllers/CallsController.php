<?php

namespace App\Http\Controllers;

use App\Models\Calls;
use App\Models\User;
use Illuminate\Http\Request;

class CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Calls $calls)
    {
        //SELECT *, AVG(externalCallScore) as AverageUserScore
        //FROM `calls`
        //WHERE duration > 10
        //GROUP BY user
        //ORDER BY `calls`.`duration` ASC

        //SELECT *, AVG(externalCallScore) as AverageUserScore
        //FROM `users`
        //JOIN calls ON calls.user_id = users.id
        //GROUP BY user
        //ORDER BY `calls`.`duration` ASC

        //SELECT *
        //FROM `users`
        //JOIN calls ON calls.user_id = users.id
        //ORDER BY `calls`.`duration` ASC

        $calls = $calls->with('user')->where('duration', '>', 10)->paginate(10);

//        dd($calls);

        return view('calls.index')->with('calls', $calls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Calls $calls, User $users)
    {
        $users = $users->get();
        $clients = $calls->distinct()->get('client');
        $clientType = $calls->distinct()->get('clientType');
        $callType = $calls->distinct()->get('typeOfCall');

        return view('calls.create',
            [
                'users' => $users,
                'clients' => $clients,
                'clientType' => $clientType,
                'callType' => $callType
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Calls $calls)
    {
        $calls->create($this->validateCalls($request));

        $calls = $calls->with('user')->where('duration', '>', 10)->paginate(10);

        return redirect('calls/?page=' . $calls->lastPage())
            ->with('flash_success', 'Call created Successfully !');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calls  $calls
     * @return \Illuminate\Http\Response
     */
    public function show(Calls $calls)
    {
        $calls = $calls->with('user')->get();

        dd($calls);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calls  $calls
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id, Calls $calls, User $users)
    {
        $call = Calls::find($id);
        $users = $users->get();
        $clients = $calls->distinct()->get('client');
        $clientType = $calls->distinct()->get('clientType');
        $callType = $calls->distinct()->get('typeOfCall');

        return view('calls.edit',
            [
                'call' => $call,
                'users' => $users,
                'clients' => $clients,
                'clientType' => $clientType,
                'callType' => $callType
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calls  $calls
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, Calls $calls)
    {
        $calls->find($id)->update($this->validateCalls($request));

        return redirect('calls')
            ->with('flash_success', 'Call updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calls  $calls
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Calls $calls)
    {
        $calls->find($id)->delete();

        return redirect('calls')
            ->with('flash_success', 'Call deleted Successfully !');
    }

    protected function validateCalls(Request $request)
    {
        return $request->validate([
            'user_id' => ['required'],
            'client' => ['required', 'string'],
            'clientType' => ['required'],
            'date' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'duration' => ['required', 'numeric', 'min:0'],
            'typeOfCall' => ['required'],
            'externalCallScore' => ['required', 'numeric', 'min:0', 'max:100']
        ]);
    }
}
