<?php

namespace App\Http\Controllers\Advert;

use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Services\ImageService;
use App\Services\AdvertService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Auth\Access\AuthorizationException;

class AdvertController extends Controller
{
    private ImageService $imageService;

    private AdvertService $advertService;

    /**
     * @param AdvertService $advertService
     * @param ImageService $imageService
     */
    public function __construct(AdvertService $advertService, ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->advertService = $advertService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The request containing query and page data.
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);
        $perPage = 10;

        if ($query) {
            $searchResults = Advert::search($query)->get();
            $total = $searchResults->count();

            $items = $searchResults->forPage($page, $perPage)->values();

            $adverts = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => request()->url(),
                'query' => request()->query(),
            ]);
        } else {
            $adverts = Advert::inRandomOrder()->paginate($perPage);
        }

        return view('adverts.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::all();

        return view('adverts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdvertRequest $request The request containing advert data.
     * @return Application|Factory|View|RedirectResponse
     */
    public function store(StoreAdvertRequest $request): Factory|View|Application|RedirectResponse
    {
        $validated = $request->validated();

        if ($request->input('action') === 'preview') {
            $advert = new Advert($validated);
            return view('adverts.preview', compact('advert'));
        }

        $this->advertService->createAdvert($validated);

        return redirect()->route('profile.adverts');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id UUID of the advert
     * @return Factory|View|Application
     */
    public function show(string $id): Factory|View|Application
    {
        $advert = Advert::with(['user', 'images'])->findOrFail($id);

        $mainImageUrl = $this->imageService->getMainImageUrl($advert, 'images/advert-test.jpg');
        $thumbnailUrls = $this->imageService->getAllImageUrls($advert);

        $avatarUrl = $this->imageService->getImageUrl(
            $advert->user?->image_path,
            'images/default-avatar.png'
        );

        return view('adverts.show', compact('advert', 'mainImageUrl', 'thumbnailUrls', 'avatarUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id UUID of the advert
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function edit(string $id): Factory|View|Application
    {
        $categories = Category::all();
        $advert = Advert::with('images')->findOrFail($id);

        $this->authorize('update', $advert);

        return view('adverts.edit', compact('advert', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAdvertRequest $request The request containing advert data.
     * @param string $id UUID of the advert
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(StoreAdvertRequest $request, string $id): Application|Factory|View|RedirectResponse
    {
        $validated = $request->validated();

        if ($request->input('action') === 'preview') {
            $advert = new Advert($validated);
            return view('adverts.preview', compact('advert'));
        }

        $this->advertService->updateAdvert($id, $validated);

        return redirect()->route('profile.adverts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id UUID of the advert
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(string $id): RedirectResponse
    {
        $advert = Advert::findOrFail($id);

        $this->authorize('delete', $advert);

        $advert->delete();

        return redirect()->route('profile.adverts');
    }
}
