{{-- 
    Vista de registro de usuario en Laravel utilizando Blade.

    Extiende la plantilla 'layout.layout'.

    Sección 'content':
    - Contenedor principal con un fondo degradado y centrado.
    - Imagen del logo centrada.
    - Formulario de registro dentro de un contenedor con estilo.
    
    Formulario de registro:
    - Acción: Enviar datos al método 'register.post' mediante POST.
    - Protección CSRF.
    - Manejo de mensajes de éxito y error.
    - Campos del formulario:
        - Email: Campo de entrada para el correo electrónico con validación de errores.
        - Username: Campo de entrada para el nombre de usuario con validación de errores.
        - Password: Campo de entrada para la contraseña con validación de errores.
        - Confirm Password: Campo de entrada para confirmar la contraseña.
    - Botón de envío del formulario.
    - Enlace para redirigir a la página de inicio de sesión si ya se tiene una cuenta.
--}}
@extends('layout.layout')

@section('content')
<div class="h-screen w-full bg-gradient-to-b from-white to-purple-300 flex flex-col items-center justify-start">
    <div class="flex flex-col items-center">
        <div class="mb-8">
            <img src="Logo.png" alt="Imagen" style="width: auto; height: 80%;">
        </div>
    </div>
        <div class="w-full max-w-md bg-beige p-6 rounded-lg shadow-md mx-auto bg-gray-100">
            <h1 class="text-6xl font-serif text-gray-700 mb-8 text-center">
                SIGA
            </h1>
            <form action="{{route('register.post')}}" method="POST">
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
                        <div >
                            <label for="email" class="block text-md font-medium text-gray-700 text">Email</label>
                            <input type="email" name="email" placeholder="Enter email" value="{{old('email')}}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                            <div class="error">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="name" class="block text-md font-medium text-gray-700 text">Username</label>
                            <input type="text" name="name" placeholder="Enter Username" value="{{old('name')}}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                            <div class="error">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block text-md font-medium text-gray-700 text">Password</label>
                            <input type="password" name="password" placeholder="Enter password" value="{{old('password')}}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="error">
                                @error('password')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-md font-medium text-gray-700 text">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm password" 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <br>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-md focus:outline-none focus:shadow-outline">
                            Register</button>
                        <br>
                        <br>
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 underline font-semibold"> Already have an account? Login here</a>

                    </form>
<div>
@endsection
