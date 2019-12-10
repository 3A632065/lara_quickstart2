<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * 判斷當給定的使用者可以刪除給定的任務。
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    //限制只有使用者自己可以刪除自己的 task
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
