<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Flacky Dashboard')</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script>
if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
}
</script>
</head>
<body class="bg-slate-100 dark:bg-slate-900 min-h-screen transition-colors duration-300">

<nav class="bg-gradient-to-r from-slate-800 to-slate-600 dark:from-slate-950 dark:to-slate-800 text-white px-10 py-5 flex justify-between items-center">
<a href="{{ route('flacks.index') }}" class="text-xl font-semibold text-white">Flacky Manager</a>
<div class="flex items-center gap-4">
<button onclick="toggleTheme()" class="bg-white/10 hover:bg-white/20 rounded-full w-10 h-10 flex items-center justify-center transition">
<span id="theme-icon">🌙</span>
</button>
<a href="{{ route('flacks.create') }}" class="bg-gradient-to-r from-teal-400 to-purple-500 text-white px-5 py-2.5 rounded-full text-sm font-medium hover:scale-105 transition">+ New Flack</a>
</div>
</nav>

<div class="w-[85%] mx-auto mt-10">
@yield('content')
</div>

<script>
function toggleTheme() {
    var html = document.documentElement;
    var icon = document.getElementById('theme-icon');
    html.classList.toggle('dark');
    if (html.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
        icon.textContent = '☀️';
    } else {
        localStorage.setItem('theme', 'light');
        icon.textContent = '🌙';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var icon = document.getElementById('theme-icon');
    if (document.documentElement.classList.contains('dark')) {
        icon.textContent = '☀️';
    }
});
</script>

</body>
</html>