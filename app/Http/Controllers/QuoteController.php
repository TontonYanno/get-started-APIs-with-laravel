<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::all();
        return response()->json($quotes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required|string',
            'author'=>'string|nullable',
        ]);

        $quote= Quote::create($request->all());
        return response()->json($quote,201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $quote=Quote::find($id);
        if (!$quote) {
            return response()->json(['message'=>'Citation introuvable'],404);
        }
        return response()->json($quote);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $quote = Quote::find($id);
        if (! $quote) {
            return response()->json(['message'=>'Citation introuvable'],404);
        }
        $request->validate([
            'content'=>'string',
            'author'=>'string|nullable'
        ]);
        $quote->update($request->all());
        return response()->json($quote);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $quote=Quote::find($id);
        if (! $quote) {
            return response()->json(['mesage'=>'Citation introuvable'], 404);
        }
        $quote->delete();
        return response()->json(['message'=>'Citation supprimée']);
    }
}
