<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{

    public function index(){

            $notes = null;

            if (Auth::user()->role == 1) {
                $notes = \App\Models\Note::all()
                    ->sortBy([
                        ['favorite', 'desc'],
                        ['title', 'asc']
                    ]);
            }
            else {
                $notes = Auth::user()->notes
                    ->sortBy([
                        ['favorite', 'desc'],
                        ['title', 'asc']
                    ]);
            }



            return view('notes.index', [
                'notes' => $notes
            ]);
        }

    public function destroy(Note $note) {

        if (!Gate::allows('isManager') && !Gate::allows('change-note', $note)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $note->delete();

        return back()->with('success', 'Your note has been deleted.');
    }



    public function edit(Note $note) {

        if (!Gate::allows('isManager') && !Gate::allows('change-note', $note)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('notes.edit', [
                'note' => $note
            ]);

    }

    public function show(Note $note) {

        if (!Gate::allows('isManager') && !Gate::allows('change-note', $note)) {
            abort(Response::HTTP_FORBIDDEN);
        }


        return view('notes.show', [
            'note' => $note
        ]);

    }

    public function favorite(Note $note) {
        if (!Gate::allows('isManager') && !Gate::allows('change-note', $note)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $note->favorite = !$note->favorite;
        $note->save();

        return back()
            ->with('success', 'Saved favorite');

    }

    public function update(Note $note) {

        if (!Gate::allows('isManager') && !Gate::allows('change-note', $note)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $attributes = request()->validate([
            'title' => 'required|max:200',
            'content' => 'required|min:2|max:255'
        ]);

        $note->update($attributes);

        return back()
            ->with('success', 'Saved');

    }

    public function duplicate(Note $note) {


        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $note->title,
                'content' => $note->content,
                'favorite' => $note->favorite
            ]);

        return back()
            ->with('success', 'Duplicated');

    }

    public function createUser() {
        $attributes = request()->validate([
            'name' => 'required|min:1|max:200',
            'email' => 'email:rfc',
            'password' => 'required|min:1|max:200'
        ]);

        $user = new User($attributes);
        $user->save();

        return back()
            ->with('success', 'Saved');
    }

    public function store() {

        $attributes = request()->validate([
            'title' => 'required|max:200',
            'content' => 'required|min:2|max:255'
        ]);

        auth()
            ->user()
            ->notes()
            ->create($attributes);

        return back()
            ->with('success', 'Saved');

    }
}
