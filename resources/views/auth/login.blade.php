{{-- 
    Vista de la página de inicio de sesión para la aplicación SIGA.

    Extiende la plantilla principal 'layout.layout'.

    Sección 'content':
    - Contenedor principal con un fondo degradado y centrado vertical y horizontalmente.
    - Logo de la aplicación en la parte superior.
    - Formulario de inicio de sesión centrado con un diseño responsivo y estilizado.

    Formulario de inicio de sesión:
    - Acción: Enviar los datos del formulario a la ruta 'login.post' mediante el método POST.
    - Protección CSRF: Incluye un token CSRF para proteger contra ataques de falsificación de solicitudes.
    - Manejo de errores: Muestra mensajes de error específicos para los campos 'email' y 'password', así como mensajes de éxito o error generales.
    - Campos:
        - Correo Electrónico: Campo de entrada de tipo email con validación y manejo de errores.
        - Contraseña: Campo de entrada de tipo password con validación y manejo de errores.
    - Botón de envío: Botón estilizado para enviar el formulario.
    - Enlace de registro: Enlace para redirigir a la página de registro si el usuario no tiene una cuenta.

    Comentario:
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
@endsection
