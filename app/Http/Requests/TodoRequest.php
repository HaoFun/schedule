<?php

namespace App\Http\Requests;

class TodoRequest extends BaseRequest
{
    public function rules()
    {
        switch (request()->route()->getName()) {
            case 'todos.search' : {
                return [
                    'is_done' => 'in:1,0,true,false',
                    'start_date' => 'date',
                    'with' => 'in:paginate'
                ];
            }
            case 'todos.store' : {
                return [
                    'is_done' => 'in:1,0,true,false',
                    'user_id' => 'required|exists:users,id',
                    'todo' => 'required|min:3',
                    'start_date' => 'nullable|date',
                    'due_date' => 'nullable|date'
                ];
            }
            case 'todos.update' : {
                return [
                    'is_done' => 'in:1,0,true,false',
                    'todo' => 'min:3',
                    'start_date' => 'nullable|date',
                    'due_date' => 'nullable|date'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
