<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'cropped_image' => ['nullable', 'string'],
            'name' => ['required', 'string', 'max:255'],
        ]);


        // Обновление имени
        $user->name = $validated['name'];
        $user->save();

        if ($request->hasFile('profile_image')) {
            $request->user()->clearMediaCollection(User::IMAGE_COLLECTION);

            $request->user()->addMediaFromRequest('profile_image')
                ->toMediaCollection(User::IMAGE_COLLECTION);
        }

        return back()->with('success', 'Профиль успешно обновлен!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Пароль успешно изменен!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Удаление пользователя
        $user->delete();

        // Завершение сеанса
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Ваш профиль был успешно удален.');
    }

}
