<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Session;
class TasksController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		$tasks = Task::all();

		return view('tasks.index')->withTasks($tasks);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
			// dd($request->all());
		$this->validate($request, [
		    'title' => 'required',
		    'description' => 'required'
		]);

		$input = $request->all();
		Task::create($input);

		Session::flash('flash_message', 'Task successfully added!');

		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$tasks = Task::findOrFail($id);
		return view('tasks.show')->withTask($tasks);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$task = Task::findOrFail($id);
		return view('tasks.edit')->withTask($task);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		//
			
	    $task = Task::findOrFail($id);

	    $this->validate($request, [
	        'title' => 'required',
	        'description' => 'required'
	    ]);

	    $input = $request->all();

	    $task->fill($input)->save();

	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect()->back();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		    $task = Task::findOrFail($id);

	    $task->delete();

	    Session::flash('flash_message', 'Task successfully deleted!');

	    return redirect()->route('tasks.index');
	}

}
