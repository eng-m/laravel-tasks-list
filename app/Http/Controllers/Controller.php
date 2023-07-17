<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(Request $request)
    {
        $query = Task::query();

        // Sort the tasks based on the selected option
        $sort = $request->input('sort');
        if ($sort == 'pending') {
            $query->where('completed', false);
        } elseif ($sort == 'completed') {
            $query->where('completed', true);
        } elseif ($sort == 'created_date') {
            $query->orderBy('created_at', 'desc');
        }

        $tasks = $query->paginate(10);

        return view('index', compact('tasks'));
    }


}