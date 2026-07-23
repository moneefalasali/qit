<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Farmer;
use App\Models\Worker;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = auth()->user();
            
            if ($user->role === 'farmer') {
                return redirect()->route('farmer.dashboard');
            } elseif ($user->role === 'worker') {
                return redirect()->route('worker.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:farmer,worker',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'city' => 'required|string|max:255',
            'national_id' => [
                'nullable',
                'string',
                'max:50',
                'unique:workers,national_id',
                'required_if:role,worker',
            ],
        ], [
            'national_id.required_if' => 'رقم الهوية مطلوب عند تسجيل عامل زراعي.',
            'national_id.string' => 'يجب أن يكون رقم الهوية الوطنية نصًا.',
            'phone.regex' => 'يرجى إدخال رقم هاتف صحيح.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
        ]);

        if ($validated['role'] === 'farmer') {
            Farmer::create([
                'user_id' => $user->id,
                'farm_name' => 'مزرعة ' . $user->name,
                'farm_location' => $validated['city'],
            ]);
        } elseif ($validated['role'] === 'worker') {
            Worker::create([
                'user_id' => $user->id,
                'national_id' => $validated['national_id'],
                'status' => 'pending',
            ]);
        }

        auth()->login($user);
        return redirect()->route('home')->with('success', 'تم التسجيل بنجاح!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.')
            : back()->withErrors(['email' => 'لم نتمكن من العثور على حساب بهذا البريد الإلكتروني.']);
    }

    public function showResetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'تم إعادة تعيين كلمة المرور بنجاح!')
            : back()->withErrors(['email' => 'فشل إعادة تعيين كلمة المرور. تحقق من البيانات وحاول مرة أخرى.']);
    }
}
