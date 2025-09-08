<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use App\Models\Address;
use App\DTO\ProfileData;
use App\Http\Controllers\Controller;
use App\Services\Profile\ProfileService;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

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
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying the user's profile.
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user()->load(['address']);

        return view('profile.index', compact('user'));
    }

    /**
     * Update the profile of the authenticated user.
     *
     * @param UpdateProfileRequest $request The validated request containing user data.
     * @return RedirectResponse Redirects back to the profile page with a success message.
     * @throws UnknownProperties
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $userData = array_intersect_key($validatedData, array_flip((new User())->getFillable()));
        $addressData = array_intersect_key($validatedData, array_flip((new Address())->getFillable()));

        $dto = new ProfileData([
            'userData' => $userData,
            'addressData' => $addressData
        ]);

        $this->profileService->updateProfile($request->user(), $dto);

        return redirect()->route('profile.index')
            ->with('success', 'Ви успішно змінили свої персональні дані');
    }

    /**
     * Upload a new profile avatar for the authenticated user.
     *
     * @param Request $request The HTTP request containing the uploaded image.
     * @return RedirectResponse Redirects back to the profile page.
     */
    public function uploadAvatar(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'profile-photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $this->profileService->updateAvatar($request->user(), $validatedData['profile-photo']);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the profile avatar for the authenticated user.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirects back to the profile page.
     */
    public function deleteAvatar(Request $request): RedirectResponse
    {
        $this->profileService->deleteAvatar($request->user());

        return redirect()->route('profile.index');
    }

    /**
     * Show the user's adverts.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying the user's adverts.
     */
    public function adverts(Request $request): Factory|View|Application
    {
        $adverts = $request->user()->adverts()
            ->with(['images' => fn($q) => $q->where('main_image', true)])
            ->latest()
            ->paginate(10);

        return view('profile.adverts', compact('adverts'));
    }
}
