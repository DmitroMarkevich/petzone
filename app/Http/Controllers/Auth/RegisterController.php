<?php

namespace App\Http\Controllers\Auth;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, FileUploadTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data): User
    {
        $id = Uuid::uuid4();

        $imagePath = null;

        // Check if the logo is present and handle the file upload
        if (isset($data['logo'])) {
            $imagePath = $this->uploadFile("users/$id", $data['logo']);
        }

        return User::create([
            'id' => $id,
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'image_path' => $imagePath,
        ]);
    }
}
