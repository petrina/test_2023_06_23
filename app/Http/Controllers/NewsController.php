<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SearchRequest;
use App\Models\PostTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Iterators\NewsCollection;

class NewsController extends Controller
{
    public function search(SearchRequest $request): JsonResponse
    {
        try {
            $searchTerm = $request->validated();
            $results = PostTranslation::where('title', 'LIKE', '%' . $searchTerm['search'] . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm['search'] . '%')
                ->orWhere('content', 'LIKE', '%' . $searchTerm['search'] . '%')
                ->get();
            $newsCollection = new NewsCollection($results);
            $iterator = $newsCollection->getIterator();
            $newsSearchResult = [];
            while ($iterator->valid()) {
                $news = $iterator->current();
                $newsSearchResult[] = [
                    'title' => $news->title,
                    'description' => $news->description,
                    'content' => $news->content,
                ];

                $iterator->next();
            }
            return response()->json($newsSearchResult);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error search'], 500);
        }
    }

}
