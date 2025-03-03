<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Services\ProfileService;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    /**
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the profile page for the authenticated user.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $user = auth()->user();
        $address = $user->deliveryAddress;

        return view('profile.index', compact('user', 'address'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->profileService->updateProfile(auth()->user(), $validatedData);

        return redirect()->route('profile.index');
    }

    /**
     * Upload a new profile logo for the authenticated user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function uploadLogo(Request $request): RedirectResponse
    {
        $request->validate(['logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048']);
        $this->profileService->uploadLogo(auth()->user(), $request->file('logo'));

        return redirect()->route('profile.index');
    }

    /**
     * Remove the profile logo for the authenticated user.
     *
     * @return RedirectResponse
     */
    public function removeLogo(): RedirectResponse
    {
        $this->profileService->removeLogo(auth()->user());

        return redirect()->route('profile.index');
    }

    /**
     * Show the user's adverts.
     *
     * @return Factory|View|Application
     */
    public function adverts(): Factory|View|Application
    {
        $adverts = auth()->user()->adverts;

        return view('profile.adverts', compact('adverts'));
    }
}
