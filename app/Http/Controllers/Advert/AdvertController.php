<?php

namespace App\Http\Controllers\Advert;

use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Services\AdvertService;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
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
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying the adverts.
     */
    public function index(Request $request): Factory|View|Application
    {
        $userId = $request->user()->id;
        $query = $request->input('query');
        $adverts = $this->advertService->getAdverts($query, 10, $userId);

        $adverts->getCollection()->transform(function ($advert) {
            $advert->in_wishlist = $advert->wishlists->isNotEmpty();
            return $advert;
        });

        return view('adverts.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application The view with the advert creation form.
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::all();

        return view('adverts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdvertRequest $request The validated request with advert data.
     * @return Application|Factory|View|RedirectResponse Redirects to profile adverts or shows preview.
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
     * Display the specified advert.
     *
     * @param string $id UUID of the advert.
     * @return Factory|View|Application The view displaying advert details.
     */
    public function show(string $id): Factory|View|Application
    {
        $advert = Advert::with(['user', 'images'])->findOrFail($id);

        // todo abstracting photo transmission and processing
        $avatarUrl = $this->imageService->getImageUrl($advert->user?->image_path, 'images/default-avatar.png');

        return view('adverts.show', compact('advert', 'avatarUrl'));
    }

    /**
     * Show the form for editing the specified advert.
     *
     * @param string $id UUID of the advert.
     * @return Factory|View|Application The view with advert edit form.
     * @throws AuthorizationException If the user is not authorized to edit the advert.
     */
    public function edit(string $id): Factory|View|Application
    {
        // todo refactor the logic for receiving categories (long response from the database)
        $categories = Category::all();
        $advert = Advert::with('images')->findOrFail($id);

        $this->authorize('update', $advert);

        return view('adverts.edit', compact('advert', 'categories'));
    }

    /**
     * Update the specified advert in storage.
     *
     * @param StoreAdvertRequest $request The request containing updated advert data.
     * @param string $id UUID of the advert.
     * @return Application|Factory|View|RedirectResponse Redirects to profile adverts or shows preview.
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
     * Remove the specified advert from storage.
     *
     * @param string $id UUID of the advert.
     * @return RedirectResponse Redirects to profile adverts after deletion.
     * @throws AuthorizationException If the user is not authorized to delete the advert.
     */
    public function destroy(string $id): RedirectResponse
    {
        $advert = Advert::findOrFail($id);

        $this->authorize('delete', $advert);

        $advert->delete();

        return redirect()->route('profile.adverts');
    }
}
