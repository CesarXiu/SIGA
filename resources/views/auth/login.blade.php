@extends('layout.layout')

@section('content')
<div class="h-screen w-full bg-gradient-to-b from-white to-purple-300 flex flex-col items-center justify-start">
        <div class="flex flex-col items-center">
            <div class="mb-8">
                <img src="/Logo.png" alt="Imagen" style="width: auto; height: 80%;">
            </div>
        </div>
        <div class="w-full max-w-md bg-beige p-6 rounded-lg shadow-md mx-auto bg-gray-100">
            <h1 class="text-6xl font-serif text-gray-700 mb-8 text-center">
                SIGA
            </h1>
            <form action="{{route('login.post')}}" method="POST" class="space-y-4">
            @csrf
            @error('success')
                <div class="success">
                    {{$message}}
                </div>
                <br><br>
            @enderror
            @error('error')
                <div class="error">
                    {{$message}}
                </div>
                <br><br>
            @enderror
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" required
                        value="{{old('email')}}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
                        <div class="error">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
                    </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
                        <div class="error">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>    
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-md focus:outline-none focus:shadow-outline">
                    Ingresar
                </button>
            </form>
            <br>
            <a href="{{route('register')}}" class="text-blue-500 hover:text-blue-700 underline font-semibold">Don't have an account? Register here</a>
        </div>
    </div>
<!--<form action="{{route('login.post')}}" method="POST">
    @csrf
    @error('success')
        <div class="success">
            {{$message}}
        </div>
        <br><br>
    @enderror
    @error('error')
        <div class="error">
            {{$message}}
        </div>
        <br><br>
    @enderror
    <div class="form-input">
        <label for="email">Email</label>
        <br>
        <input type="email" name="email" placeholder="Enter email" value="{{old('email')}}">
        <div class="error">
            @error('email')
                {{$message}}
            @enderror
        </div>
    </div>

    <div class="form-input">
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" placeholder="Enter password">
        <div class="error">
            @error('password')
                {{$message}}
            @enderror
        </div>
    </div>
    <br>
    <button type="submit">Login</button>
    <br>
    Don't have an account? <a href="{{route('register')}}">Register here</a>
</form>-->
@endsection