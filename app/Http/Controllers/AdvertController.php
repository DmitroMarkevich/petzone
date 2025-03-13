<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Services\AdvertService;
use App\Http\Requests\StoreAdvertRequest;

class AdvertController extends Controller
{
    private AdvertService $advertService;

    /**
     * @param AdvertService $advertService
     */
    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::all();

        return view('adverts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $this->advertService->createAdvert($validated);

        return redirect()->route('profile.adverts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Factory|View|Application
    {
        $advert = Advert::findOrFail($id);
        $owner = $advert->user;
        $images = $advert->images;

        return view('adverts.show', compact('advert', 'owner', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $advert = Advert::findOrFail($id);
        $advert->delete();

        return redirect()->route('profile.adverts');
    }

    public function search(Request $request): Factory|View|Application
    {
        $query = $request->input('query');

        if ($query) {
            $adverts = Advert::search($query)->paginate(10, 'page', $request->page ?? 1);
        } else {
            $adverts = Advert::inRandomOrder()->paginate(10);
        }

        return view('adverts.index', compact('adverts'));
    }
}
