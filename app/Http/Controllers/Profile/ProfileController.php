<?php

namespace App\Http\Controllers\Profile;

use App\DTO\ProfileData;
use App\Http\Controllers\Controller;
use App\Services\Profile\ProfileService;
use App\Http\Requests\UploadAvatarRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user()->load(['address']);

        return view('profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $dto = ProfileData::fromRequest($request);

        $this->profileService->updateProfile($request->user(), $dto);

        return redirect()->route('profile.index')
            ->with('success', 'Ви успішно змінили свої персональні дані');
    }

    public function uploadAvatar(UploadAvatarRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->profileService->updateAvatar($request->user(), $validatedData['profile-photo']);

        return redirect()->route('profile.index')
            ->with('success', 'Ви успішно змінили аватар профіля');
    }

    public function deleteAvatar(Request $request): RedirectResponse
    {
        $wasDeleted = $this->profileService->deleteAvatar($request->user());

        if ($wasDeleted) {
            return redirect()->route('profile.index')
                ->with('success', 'Ви успішно видалили аватар профіля');
        }

        return redirect()->route('profile.index')
            ->with('error', 'Аватар вже відсутній');
    }

    public function adverts(Request $request): Factory|View|Application
    {
        $adverts = $request->user()->adverts()
            ->with(['images' => fn($q) => $q->where('main_image', true)])
            ->latest()
            ->paginate(10);

        return view('profile.adverts', compact('adverts'));
    }
}
