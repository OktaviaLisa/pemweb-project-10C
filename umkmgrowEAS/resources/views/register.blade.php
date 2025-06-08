@extends('layout.login-layout')

@section('content')
<div class="bg-secondary flex items-center justify-center min-h-screen relative">

    @if (session('error_general'))
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                {{ session('error_general') }}
            </div>
        </div>
    @endif

    <div class="bg-white w-full max-w-3xl h-[500px] rounded-lg shadow-md flex overflow-hidden">

        {{-- Gambar --}}
        <div class="w-1/2 text-white p-6 rounded-l-lg bg-cover bg-center"
             style="background-image: url('{{ asset('img/registercover.jpg') }}');">
        </div>

        {{-- Form --}}
        <div class="w-1/2 p-6 overflow-auto">
            <h2 class="text-xl font-bold text-center text-secondary">Daftar</h2>
            <form action="{{ route('register.proses') }}" method="POST" class="mt-4 space-y-0.75">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Email*</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm @error('email') border-red-500 @enderror">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        @error('email') {{ $message }} @else &nbsp; @enderror
                    </p>
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Username*</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm @error('username') border-red-500 @enderror">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        @error('username') {{ $message }} @else &nbsp; @enderror
                    </p>
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Nama Lengkap*</label>
                    <input type="text" name="namalengkap" value="{{ old('namalengkap') }}" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm @error('namalengkap') border-red-500 @enderror">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        @error('namalengkap') {{ $message }} @else &nbsp; @enderror
                    </p>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Password*</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm @error('password') border-red-500 @enderror">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        @error('password') {{ $message }} @else &nbsp; @enderror
                    </p>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Konfirmasi Password*</label>
                    <input type="password" name="konfirpass" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm @error('konfirpass') border-red-500 @enderror">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] password-error-msg">
                        @error('konfirpass') {{ $message }} @else &nbsp; @enderror
                    </p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 mt-2 rounded-md text-sm hover:bg-orange-500 transition duration-300">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
