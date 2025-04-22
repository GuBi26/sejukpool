@include('components.head')
@include('components.navbar')

<div class="p-6 min-h-screen flex flex-col justify-center items-center bg-green-50">
    <h1 class="text-2xl font-bold text-green-600 mb-4">Pembayaran Berhasil!</h1>
    <p class="text-gray-700 mb-2">Terima kasih, sselamat berenang.</p>
    <p class="text-gray-600">Order ID: {{ $order->order_id }}</p>
    <a href="{{ route('history') }}" class="mt-6 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
        Lihat Riwayat Pesanan
    </a>
</div>
