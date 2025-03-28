<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Services\OrderService;
use App\Services\ProfileService;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    private OrderService $orderService;

    private ProfileService $profileService;

    /**
     * @param OrderService $orderService
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService, OrderService $orderService)
    {
        $this->orderService = $orderService;
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

    /**
     * Update the profile of the authenticated user.
     *
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->profileService->updateProfile(auth()->user(), $validatedData);

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

        $this->profileService->updateAvatar(auth()->user(), $profilePhoto);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the profile avatar for the authenticated user.
     *
     * @return RedirectResponse
     */
    public function deleteAvatar(): RedirectResponse
    {
        $this->profileService->deleteAvatar(auth()->user());

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

    /**
     * Show the user's orders.
     *
     * @return Factory|View|Application
     */
    public function orders(): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders(true);

        return view('profile.orders', compact('orders'));
    }

    /**
     * Show the user's orders history.
     *
     * @return Factory|View|Application
     */
    public function ordersHistory(): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders(false);

        return view('profile.orders-history', compact('orders'));
    }
}
