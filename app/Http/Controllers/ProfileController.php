<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

        // Сохранение обрезанного изображения
        if ($request->filled('cropped_image')) {
            $imageData = $validated['cropped_image'];
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Удаление старого аватара
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Сохранение нового аватара
            $avatarPath = 'avatars/' . uniqid() . '.png';
            Storage::disk('public')->put($avatarPath, $image);
            $user->avatar = $avatarPath;
        }

        // Обновление имени
        $user->name = $validated['name'];
        $user->save();

        return back()->with('success', 'Профиль успешно обновлен!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
