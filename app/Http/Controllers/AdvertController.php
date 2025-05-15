<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Services\AdvertService;
use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\PreviewAdvertRequest;
use Illuminate\Session\Store;

class AdvertController extends Controller
{
    private AdvertService $advertService;

    /**
     * Number of items per page for pagination.
     */
    private const PAGINATION_LIMIT = 10;

    /**
     * @param AdvertService $advertService
     */
    public function __construct(AdvertService $advertService)
    {
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

        if ($query) {
            $searchResults = Advert::search($query);
            $adverts = $searchResults->paginate(self::PAGINATION_LIMIT, 'page', $page);
        } else {
            $randomAdverts = Advert::inRandomOrder();
            $adverts = $randomAdverts->paginate(self::PAGINATION_LIMIT);
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
     * @return RedirectResponse
     */
    public function store(StoreAdvertRequest $request): RedirectResponse
    {
        $validated = $request->validated();
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

        return view('adverts.show', compact('advert'));
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
