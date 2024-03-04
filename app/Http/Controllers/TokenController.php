<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TokenController extends Controller
{
    public function index()
    {
        return view('tokens');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title'=>'required|max:255' , 'abilities' => ['required', 'array', Rule::in(['note.list', 'note.edit', 'note.create', 'note.delete'])]
        ]);

        $token = auth()->user()->createToken($attributes['title'], $attributes['abilities']);

        return back()-> with([
            'success'=>__('Your token has been created.'),
            'token'=>$token->plainTextToken
        ]);

    }

}
