<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsPostRequest;
use App\Models\NewsPost;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    protected SlugService $slugService;
    protected ImageService $imageService;

    public function __construct(SlugService $slugService, ImageService $imageService)
    {
        $this->slugService  = $slugService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $q        = request('q');
        $status   = request('status');
        $category = request('category');

        $newsPosts = NewsPost::when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
                             ->when($status, fn($query) => $query->where('status', $status))
                             ->when($category, fn($query) => $query->where('category_tag', $category))
                             ->orderBy('created_at', 'desc')
                             ->paginate(15)
                             ->withQueryString();

        $categories = NewsPost::whereNotNull('category_tag')->distinct()->pluck('category_tag');

        return view('admin.news.index', compact('newsPosts', 'categories'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsPostRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->slugService->generate($data['title'], NewsPost::class);

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image_path'] = $this->imageService->store($request->file('featured_image'), 'news');
        }

        unset($data['featured_image']);

        NewsPost::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được tạo thành công.');
    }

    public function edit(NewsPost $news)
    {
        return view('admin.news.edit', ['newsPost' => $news]);
    }

    public function update(StoreNewsPostRequest $request, NewsPost $news)
    {
        $data = $request->validated();

        if ($data['title'] !== $news->title) {
            $data['slug'] = $this->slugService->generate($data['title'], NewsPost::class, $news->id);
        }

        if ($data['status'] === 'published' && empty($data['published_at']) && !$news->published_at) {
            $data['published_at'] = Carbon::now();
        }

        if ($request->hasFile('featured_image')) {
            $this->imageService->delete($news->featured_image_path);
            $data['featured_image_path'] = $this->imageService->store($request->file('featured_image'), 'news');
        }

        unset($data['featured_image']);

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(NewsPost $news)
    {
        $this->imageService->delete($news->featured_image_path);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được xóa thành công.');
    }
}
