<?php

namespace App\Http\Controllers;

use App\Jobs\SendingAlertForNewArticle;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'filled|integer',
            'per_page' => 'filled|integer'
        ]);

        return Cache::remember('websites-'.$request->page ?? 1, 10, function() use ($request) {
            return Website::simplePaginate($request->per_page ?? 5);
        });
    }

    public function show($id)
    {
        if (!$website = Website::find($id)) {
            return response([
                'message' => 'Website not found.'
            ], 404);
        }

        return $website;
    }

    public function storeSubscriber(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        if (!$website = Website::find($id)) {
            return response([
                'message' => 'Website not found.'
            ], 404);
        }

        return $website->subscribers()
            ->firstOrCreate([
                'email' => $request->email
            ]);
    }

    public function storeArticle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        if (!$website = Website::find($id)) {
            return response([
                'message' => 'Website not found.'
            ], 404);
        }

        $article = $website->articles()
            ->firstOrCreate([
                'title' => $request->title,
                'content' => $request->content,
            ]);

        SendingAlertForNewArticle::dispatch($article);

        return $article;
    }
}
