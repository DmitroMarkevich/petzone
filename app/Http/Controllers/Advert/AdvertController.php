<?php

namespace App\Http\Controllers\Advert;

use App\DTO\AdvertData;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Services\AdvertService;
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
    private AdvertService $advertService;

    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * Displays a list of adverts with optional search query and sorting.
     */
    public function index(Request $request): Factory|View|Application
    {
        $userId = $request->user()->id;
        $query = $request->input('query');
        $sort = $request->input('sort');

        $adverts = $this->advertService->getAdverts($query, $userId, $sort);

        $adverts->getCollection()->transform(function ($advert) {
            $advert->in_wishlist = $advert->wishlists->isNotEmpty();
            return $advert;
        });

        return view('advert.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application The view with the advert creation form.
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::all();

        return view('advert.create', compact('categories'));
    }

    /**
     * Stores a new advert or shows a preview, depending on the action.
     */
    public function store(StoreAdvertRequest $request): Factory|View|Application|RedirectResponse
    {
        $dto = AdvertData::from($request->except('images'));
        $images = $request->file('images', []);

        if ($request->input('action') === 'preview') {
            $advert = new Advert($dto->toModelAttributes());

            return view('advert.preview', compact('advert', 'images'));
        }

        $this->advertService->createAdvert($dto, $request->user(), $images);

        return redirect()->route('profile.advert');
    }

    /**
     * Shows a single advert details.
     */
    public function show(string $id): Factory|View|Application
    {
        $advert = Advert::with(['user', 'images'])->findOrFail($id);
        $relatedAdverts = $this->advertService->getRelatedAdverts($advert);

        return view('advert.show', compact('advert', 'relatedAdverts'));
    }

    /**
     * Show the form for editing the specified advert.
     *
     * @throws AuthorizationException If the user is not authorized to edit the advert.
     */
    public function edit(string $id): Factory|View|Application
    {
        // todo refactor the logic for receiving categories (long response from the database)
        $advert = Advert::with('images')->findOrFail($id);

        $this->authorize('update', $advert);

        $categories = Category::all();

        return view('advert.edit', compact('advert', 'categories'));
    }

    /**
     * Updates the advert or shows a preview, depending on the action.
     */
    public function update(StoreAdvertRequest $request, Advert $advert): Application|Factory|View|RedirectResponse
    {
        $dto = AdvertData::from($request->validated());

        if ($request->input('action') === 'preview') {
            $advert = new Advert($dto->toModelAttributes());

            return view('advert.preview', compact('advert'));
        }

        $this->advertService->updateAdvert($advert, $dto);

        return redirect()->route('profile.advert');
    }

    /**
     * Deletes the advert after authorization check.
     *
     * @throws AuthorizationException If the user is not authorized to delete the advert.
     */
    public function destroy(string $id): RedirectResponse
    {
        $advert = Advert::findOrFail($id);

        $this->authorize('delete', $advert);

        $advert->delete();

        return redirect()->route('profile.advert');
    }
}
