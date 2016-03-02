<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Http\Requests;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{

  protected $tasks;

   /** 
    * construct
    */
    public function __construct(TaskRepository $tasks)
    {
      $this->middleware('auth');

      $this->tasks = $tasks;
    }

    /**
     * index
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

      return view('tasks.index',[
                    'tasks' => $this->tasks->forUser($request->user()),
                  ]);
    }

    /**
     * create or update a task
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $request->user()->tasks()->create([
          'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * delete a task
     * @param Request $request
     * @param Task  $task
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
    
}
