<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
<link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
<link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tabtitle')</title>
	@livewireStyles
</head>

<body>
    <div class="container">
        <center><h1>@yield('title')</h1></center>
        @livewire('post')
    </div>
	
	@livewireScripts
</body>

</html>