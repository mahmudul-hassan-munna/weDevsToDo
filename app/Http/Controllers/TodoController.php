<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo');
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

        Todo::create($request->all());

        $todos =Todo::all();

        $result = $this->todoList($todos);

        return response()
            ->json($result);

    }


    public function todoList($todos)
    {
        $content = null;
        $i = 0;
        $completed = 0;
        foreach ($todos as $todo)
        {
            $i++;

            if($todo->status == 0)
            {
                $content .= '<tr>
                <td class="td-checkbox"><input type="checkbox" id='.'checkbox-'.$todo->id.' name="todo_checkbox" class="checkbox-round" value='.$todo->id.' onclick="checkboxEvent('.$todo->id.')"></td>
                <td><p class="edit-text" id='.'todo_show-'.$todo->id.'  onclick="openEdit('.$todo->id.')" >'.$todo->name.'</p>
                <input type="text" name="name" id='.'name-'.$todo->id.' class="form-control edit-name" value="'.$todo->name.'" onkeydown="editName(event,'.$todo->id.')"  autocomplete="off">
                </td>
                </tr>';
            }
            else
            {
                $completed++;
                $content .= '<tr>
                <td class="td-checkbox"><input type="checkbox" id='.'checkbox-'.$todo->id.' name="todo_checkbox" class="checkbox-round" value='.$todo->id.' onclick="checkboxEvent('.$todo->id.')" checked disabled >
                </td>
                <td><p class="cross"  id='.'todo_show-'.$todo->id.'>'.$todo->name.'</p>
                
                </td>
                </tr>';

            }

        }

        $count_text = $i . ' items left';

        $result = array(
            'content' => $content,
            'completed' => $completed,
            'count_text' => $count_text,
        );

        return $result;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        if($status == 2)
        {
            $todos =Todo::all();
        }
        else
        {
            $todos =Todo::where('status',$status)->get();
        }
        
        $result = $this->todoList($todos);
        return response()->json($result);
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
        $todo = Todo::where('id', $id)
          ->update($request->all());

        return response()
            ->json(['completed' => $todo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($status)
    {
        Todo::where('status', $status)->delete();

        $todos =Todo::all();
        $result = $this->todoList($todos);
        return response()->json($result);
    }
}
