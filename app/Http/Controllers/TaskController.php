<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * 建立一個新的控制器實例。
     *
     * @return void
     */
    //增加 middleware 的方法，用以呼叫名稱為 auth 的中介層程式，以檢查使用者的認證
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //回傳視圖，可看到輸入任務的表單
        //return view('tasks.index');

        //顯示已有的任務
        //由 DB 擷取使用者所有任務
        //$tasks = Task::where('user_id', $request->user()->id)->get();

        /*測試 認證->使用者->任務*/                  // auth()->user()代表登入者的User model
        //$tasks= auth()->user()->tasks;

        /*測試 認證->使用者->任務->get*/
        //$tasks= auth()->user()->tasks()->get();

        /*測試 認證(另一種)->使用者->任務*/           // auth()->user()等同於Auth::user()
        //$tasks=Auth::user()->tasks;

        /*測試 認證(另一種)->使用者->任務->get*/
        $tasks=Auth::user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //驗證接收到的表單輸入並建立新的任務

        //讓 name 欄位為必填，且它必須少於 255 字元
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        //建立任務
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
