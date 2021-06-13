<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <div class="container mx-auto flex flex-col items-center justify-center h-screen">
        <form action="{{ route('login') }}" method="POST" class="bg-gray-500 p-5 login-form rounded-sm">
            @csrf
            <div class="w-full pt-1 pb-5 text-center">
                <h1 class="text-white font-bold text-xl">Faça login</h1>
            </div>
            <div class="w-full mb-4">
                <input type="email" placeholder="e-mail" class="w-full p-2 text-lg focus:outline-none" name="email">
            </div>
            <div class="mb-4">
                <input type="password" placeholder="senha" class="w-full p-2 text-lg focus:outline-none" name="password">
            </div>
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 hover:text-white py-2 px-6 text-black text-lg font-bold transition-all duration-200">Entrar</button>
            </div>
        </form>
    </div>

</body>
</html>
