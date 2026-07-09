{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="space-y-6">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-800 rounded-xl shadow-lg p-6 text-white">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-blue-100">Selamat datang di Portal Transaksi Internal Pemerintah. Sistem siap membantu
                aktivitas administrasi Anda.</p>
        </div>
    </div>
</x-app-layout>
