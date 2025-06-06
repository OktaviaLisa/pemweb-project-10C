@extends('layout.login-layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-secondary relative">

    {{-- ✅ ALERT UMUM --}}
    @if (session('success'))
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-green-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session('error_general'))
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                {{ session('error_general') }}
            </div>
        </div>
    @endif

    <div class="bg-white w-full max-w-2xl h-[500px] rounded-lg shadow-md flex overflow-hidden">

        {{-- Kiri: Gambar --}}
        <div class="w-1/2 text-white p-6 rounded-l-lg bg-cover bg-center"
             style="background-image: url('{{ asset('img/coverlogin.png') }}');">
        </div>

        {{-- Kanan: Form --}}
        <div class="w-1/2 p-6 overflow-auto">
            <h2 class="text-xl font-bold text-center text-secondary">Login</h2>

            <form action="{{ route('login.proses') }}" method="POST" class="mt-4 space-y-1">
                @csrf

                {{-- Username --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Username*</label>
                    <input type="text" name="username" value="{{ old('username') }}" required 
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    <p class="text-red-500 text-xs mt-1 h-4">
                        {{ $errors->first('username') ?? ' ' }}
                    </p>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Password*</label>
                    <input type="password" name="password" required 
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    <p class="text-red-500 text-xs mt-1 h-4">
                        {{ $errors->first('password') ?? ' ' }}
                    </p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 rounded-md text-sm hover:bg-orange-50 transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
@endsection