<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpusCard;

class OpusCardController extends Controller
{
    public function index()
    {
        return OpusCard::all();
    }

    public function show($id)
    {
        return OpusCard::find($id);
    }

    public function find($email){
        return OpusCard::where('email',$email)->first();
    }

    public function store(Request $request)
    {
        return OpusCard::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $opus = OpusCard::find($id);
        $opus->linked_with_igo=1;
        $opus->save();
        return $opus;
    }

    public function delete(Request $request, $id)
    {
        $article = OpusCard::findOrFail($id);
        $article->delete();

        return 204;
    }
}
