<?php

namespace App\Http\Controllers\Evidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvidenceController extends Controller
{
    public function index()
    {
        return view("evidence.index", [
            "title" => "Všetky zariadenia",
        ]);
    }

    public function create()
    {
        return view("evidence.create", [
            "title" => trans('ui.new_entry'),
            "backUrl" => route('evidence.index'),
        ]);
    }

    public function store()
    {

    }

    public function show()
    {
        return view("evidence.show", [
            "title" => "Záznam #1991",
            "backUrl" => route("evidence.index"),
            "showBackButton" => true,
        ]);
    }

    public function edit()
    {
        return view("evidence.edit", [
            "title" => trans('ui.edit'),
            "backUrl" => route('evidence.index'),
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
