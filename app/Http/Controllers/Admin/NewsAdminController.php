<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsAdminController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'summary'      => 'nullable|string|max:300',
            'content'      => 'required|string',
            'thumbnail'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'published_at' => 'required|date',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/news'), $thumbnailName);
        }

        News::create([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'summary'      => $validated['summary'],
            'content'      => $validated['content'],
            'thumbnail'    => $thumbnailName,
            'published_at' => $validated['published_at'],
            'status'       => 'published',
            'created_by'   => Auth::guard('admin')->id(),
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'summary'      => 'nullable|string|max:300',
            'content'      => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'published_at' => 'required|date',
        ]);

        $news->title        = $validated['title'];
        $news->summary      = $validated['summary'];
        $news->content      = $validated['content'];
        $news->published_at = $validated['published_at'];

        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail && File::exists(public_path('images/news/' . $news->thumbnail))) {
                File::delete(public_path('images/news/' . $news->thumbnail));
            }

            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/news'), $thumbnailName);

            $news->thumbnail = $thumbnailName;
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->thumbnail && File::exists(public_path('images/news/' . $news->thumbnail))) {
            File::delete(public_path('images/news/' . $news->thumbnail));
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function toggle($id)
    {
        $news = News::findOrFail($id);

        $news->status = $news->status === 'published'
            ? 'draft'
            : 'published';

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Status berita berhasil diperbarui.');
    }
}
