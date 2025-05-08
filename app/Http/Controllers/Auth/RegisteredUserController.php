<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

  /**
   * Function to get allowed roles for user registration.
   * 
   * @return array<RoleType>
   */
  protected function allowed(): array
  {
    $roles = RoleType::cases();
    $roles = array_filter($roles, function ($role) {
      return $role !== RoleType::ADMIN;
    });

    return $roles;
  }

  /**
   * Function to get allowed roles as a string.
   * 
   * @return string
   */
  protected function allowedRule(): string
  {
    $allowed = array_map(function ($role) {
      return $role->value;
    }, $this->allowed());

    return implode(',', $allowed);
  }

  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register', [
      'roles' => $this->allowed(),
    ]);
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role' => ['required', 'string', 'in:' . $this->allowedRule()],
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => $request->role,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
  }
}
