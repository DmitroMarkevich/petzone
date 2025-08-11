<?php

namespace App\Http\Controllers\Profile;

use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Services\Profile\ProfileService;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    private ImageService $imageService;
    private ProfileService $profileService;

    /**
     * @param ProfileService $profileService
     * @param ImageService $imageService
     */
    public function __construct(ProfileService $profileService, ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->profileService = $profileService;
    }

    /**
     * Show the profile page for the authenticated user.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user();
        $address = $user->address;
        $avatarUrl = $this->imageService->getImageUrl($user->image_path);

        return view('profile.index', compact('user', 'address', 'avatarUrl'));
    }

    /**
     * Update the profile of the authenticated user.
     *
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->profileService->updateProfile($request->user(), $validatedData);

        return redirect()->route('profile.index')->with('success', 'Ви успішно змінили свої персональні дані');
    }

    /**
     * Upload a new profile avatar for the authenticated user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function uploadAvatar(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'profile-photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $profilePhoto = $validatedData['profile-photo'];

        $this->profileService->updateAvatar($request->user(), $profilePhoto);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the profile avatar for the authenticated user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAvatar(Request $request): RedirectResponse
    {
        $this->profileService->deleteAvatar($request->user());

        return redirect()->route('profile.index');
    }

    /**
     * Show the user's adverts.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function adverts(Request $request): Factory|View|Application
    {
        $user = $request->user();
        $adverts = $user->adverts()->latest()->paginate(10);;

        return view('profile.adverts', compact('adverts'));
    }
}
