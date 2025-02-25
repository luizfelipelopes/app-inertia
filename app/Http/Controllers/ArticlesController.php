<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $start = microtime(true);
        $articles = Cache::remember('articles', 60, function () {
            return Article::all()->toArray();
        });

        $time = microtime(true) - $start;
        Log::info("Cache time: {$time} seconds");
        return $articles;
        // return Cache::rememberForever('articles', 
        // fn () => Article::all());
    }

    public function allWithoutCache()
    {

        $start = microtime(true);

        $articles = Article::all()->toArray();

        $time = microtime(true) - $start;
        Log::info("Cache time: {$time} seconds");
        return $articles;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
