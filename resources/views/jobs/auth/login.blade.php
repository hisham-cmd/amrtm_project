@extends('jobs.layouts.app')

@section('title', 'تسجيل الدخول - وظّفني')

@section('content')
<div class="min-h-screen from-brand-600 to-brand-800 flex items-center justify-center py-12 px-4">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full">
        <h2 class="text-3xl font-bold text-center text-surface-900 mb-2">تسجيل الدخول</h2>
        <p class="text-center text-surface-600 mb-8">أهلاً بعودتك!</p>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('jobs.login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-600" required autofocus>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-600" required>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-brand-600 rounded">
                    <span class="ml-2 text-sm text-gray-600">تذكرني</span>
                </label>
                <a href="#" class="text-sm text-brand-600 hover:underline">هل نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="w-full px-6 py-3 bg-brand-600 text-white font-bold rounded-lg hover:bg-brand-700 transition">
                تسجيل الدخول
            </button>

            <p class="text-center text-sm text-gray-600">
                لا تملك حساب؟ <a href="{{ route('jobs.register') }}" class="text-brand-600 font-bold hover:underline">إنشاء حساب الآن</a>
            </p>
        </form>
    </div>
</div>
@endsection