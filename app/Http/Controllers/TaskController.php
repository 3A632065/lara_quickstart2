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
    public function index(Request $request)
    {
        //回傳視圖，可看到輸入任務的表單
        //return view('tasks.index');

        //顯示已有的任務
        //由 DB 擷取使用者所有任務
        $tasks = Task::where('user_id', $request->user()->id)->get();

        /*測試 認證->使用者->任務*/                  // auth()->user()代表登入者的User model
        //$tasks= auth()->user()->tasks;

        /*測試 認證->使用者->任務->get*/
        //$tasks= auth()->user()->tasks()->get();

        /*測試 認證(另一種)->使用者->任務*/           // auth()->user()等同於Auth::user()
        //$tasks=Auth::user()->tasks;

        /*測試 認證(另一種)->使用者->任務->get*/
        //$tasks=Auth::user()->tasks()->get();

        //$tasks=auth()->user()->tasks()->paginate(2); //登入者任務分頁顯示，每頁2筆

        /*取得使用者相關資料或方法
        auth()->user()->id          //取的使用者的ID
        auth()->user()->name        //取得使用者的姓名
        auth()->user()->email       //取得使用者的Email
        auth()->user()->tasks       //登入後的使用者的所有任務
        auth()->user()->tasks()     //登入後的使用者與任務的1對多關係
        */

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
     * 移除給定的任務。
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');

    }
}
