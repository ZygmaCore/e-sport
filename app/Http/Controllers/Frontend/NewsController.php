<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    public function __construct(private readonly NewsRepository $newsRepository)
    {
    }

    public function index()
    {
        $news = $this->newsRepository->paginatePublished(9);

        return view('frontend.news.index', [
            'news' => $news,
        ]);
    }

    public function show(string $slug)
    {
        $news = $this->newsRepository->findBySlug($slug);

        abort_if(is_null($news), 404);

        return view('frontend.news.show', [
            'news' => $news,
        ]);
    }
}
