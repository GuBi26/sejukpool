<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Pemesanan Tiket</title>
    <style>
        /* General Styles */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }
    
        /* Header Styles */
        .top-head {
            background-color: #6a4cff;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 30px;
        }
        .top-head h1 {
            margin: 0;
            font-size: 24px;
            color: white;
        }
    
        /* Layout Styles */
        .booking-wrapper {
            display: flex;
            gap: 30px;
            max-width: 1000px;
            margin: 40px auto;
            align-items: flex-start;
        }
    
        /* Form Container Styles */
        .booking-container {
            flex: 1;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
    
        /* Form Element Styles */
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            transition: 0.3s;
            font-size: 14px;
        }
        input:focus, select:focus {
            border-color: #5f4dee;
            box-shadow: 0 0 5px rgba(95, 77, 238, 0.5);
            outline: none;
        }
    
        /* Voucher Section Styles */
        .voucher-section {
            background-color: #ece9ff;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        #apply-voucher {
            background-color: #5f4dee;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        #apply-voucher:hover {
            background-color: #4a3cc3;
        }
        #voucher-result p {
            margin-top: 8px;
            font-size: 14px;
            font-weight: bold;
        }
    
        /* Submit Button Styles */
        #submit-booking {
            width: 100%;
            padding: 14px;
            background-color: #5f4dee;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }
        #submit-booking:hover {
            background-color: #4a3cc3;
        }
    
        /* Terms & Conditions Styles */
        .terms-container {
            flex: 1;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }
        .terms-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #5f4dee;
            text-align: left;
        }
        .terms-content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        .terms-section {
            margin-bottom: 20px;
        }
        .terms-section h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .terms-list {
            list-style-type: none;
            padding-left: 5px;
            margin-top: 0;
        }
        .terms-list li {
            margin-bottom: 8px;
            line-height: 1.5;
            position: relative;
            padding-left: 20px;
            font-size: 15px;
        }
        .terms-list li:before {
            content: "-";
            position: absolute;
            left: 0;
            color: #5f4dee;
            font-weight: bold;
        }
    
        /* Custom Modal Styles */
        #confirmationModal .modal-content {
            background-color: #1a237e;
            color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .modal-backdrop.show {
    -webkit-backdrop-filter: blur(10px) saturate(50%);
    backdrop-filter: blur(10px) saturate(50%);
    background-color: rgba(0,0,50,0.5);
}
        
        #confirmationModal .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 20px;
        }
        
        #confirmationModal .modal-title {
            color: white;
            font-weight: bold;
        }
        
        #confirmationModal .modal-body {
            padding: 20px;
        }
        
        #confirmationModal .modal-footer {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 15px 20px;
        }
        
        #confirmationModal .close {
            color: white;
            opacity: 0.8;
        }
        
        #confirmationModal .close:hover {
            opacity: 1;
        }
        
        .confirmation-row {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .confirmation-label {
            font-weight: bold;
            width: 40%;
            color: #e8eaf6;
        }
        
        .confirmation-value {
            width: 60%;
            color: white;
        }
        
        /* Custom Button Styles */
        .btn-custom-primary {
            background-color: #5f4dee;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .btn-custom-primary:hover {
            background-color: #4a3cc3;
            color: white;
        }
        
        .btn-custom-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .btn-custom-secondary:hover {
            background-color: #e9e9e9;
        }
    
        /* Responsive Styles */
        @media (max-width: 768px) {
            .booking-wrapper {
                flex-direction: column;
            }
            .terms-container {
                padding: 0 20px;
            }
            .terms-title {
                font-size: 20px;
                margin-bottom: 20px;
            }
            .terms-section h3 {
                font-size: 16px;
            }
            .terms-list li {
                font-size: 14px;
            }
            
            #confirmationModal .modal-dialog {
                margin: 20px auto;
            }
        }
    </style>
</head>
<body data-spy="scroll" data-target=".fixed-top">

    @include('components.head')
    @include('components.navbar')

    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Tiket</h1>
                    <div class="breadcrumbs">
                        <a href="{{ route ('home') }}">Beranda</a>
                        <i class="fa fa-angle-double-right"></i>
                        <span>Syarat & Ketentuan</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="booking-wrapper">
        <!-- Kolom Kiri untuk Syarat dan Ketentuan -->
        <div class="terms-container">
            <div class="terms-title">Syarat & Ketentuan Pemesanan Tiket</div>
            <div class="terms-content">
                <div class="terms-section">
                    <h3>1. Pemesanan & Pembayaran</h3>
                    <ul class="terms-list">
                        <li>Pemesanan tiket dilakukan minimal 1 hari sebelum tanggal kunjungan.</li>
                        <li>Dalam sekali pemesanan, maksimal hanya dapat memesan 10 tiket.</li>
                        <li>Pembayaran dilakukan melalui metode yang tersedia (transfer bank, e-wallet, atau payment gateway).</li>
                        <li>Tiket yang sudah dibayar bersifat non-refundable dan tidak dapat dibatalkan.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>2. Penggunaan Tiket</h3>
                    <ul class="terms-list">
                        <li>Tiket hanya berlaku pada tanggal yang telah dipilih saat pemesanan.</li>
                        <li>Pengunjung wajib menunjukkan e-ticket atau bukti pemesanan saat masuk area kolam.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>3. Jam Operasional</h3>
                    <ul class="terms-list">
                        <li>Kolam renang buka setiap hari pada pukul 09.00 - 17.00 WIB.</li>
                        <li>Tidak diperkenankan berada di area kolam di luar jam operasional.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>4. Kebijakan Anak-anak</h3>
                    <ul class="terms-list">
                        <li>Anak usia di bawah 3 tahun gratis masuk.</li>
                        <li>Anak usia 3 tahun ke atas wajib membeli tiket.</li>
                        <li>Anak-anak harus dalam pengawasan orang dewasa selama di area kolam.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>5. Voucher Diskon</h3>
                    <ul class="terms-list">
                        <li>Voucher diskon hanya dapat digunakan 1 kali per akun/per transaksi.</li>
                        <li>Tidak dapat digabungkan dengan promo lain kecuali dinyatakan sebaliknya.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>6. Aturan Keselamatan</h3>
                    <ul class="terms-list">
                        <li>Pengunjung wajib mengikuti semua aturan keselamatan yang ditetapkan oleh pengelola.</li>
                        <li>Pengelola tidak bertanggung jawab atas kehilangan barang pribadi.</li>
                    </ul>
                </div>
        
                <div class="terms-section">
                    <h3>7. Lain-lain</h3>
                    <ul class="terms-list">
                        <li>Pengelola berhak menolak pengunjung yang tidak mematuhi syarat & ketentuan ini tanpa pengembalian dana.</li>
                        <li>Dengan melakukan pemesanan, pengunjung dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan ini.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan untuk Form Pemesanan -->
        <div class="booking-container">
            <div class="top-head">
                <h1>Pemesanan Tiket</h1>
            </div>
            <form id="bookingForm">
    @csrf
    <div class="form-group">
        <label for="booking_date">Tanggal Kunjungan</label>
        <input 
            type="date" 
            id="booking_date" 
            name="booking_date" 
            required
            min="{{ date('Y-m-d') }}"
        >
    </div>

    <div class="form-group">
        <label for="ticket_type">Jenis Tiket</label>
        <input 
            type="text" 
            id="ticket_type" 
            name="ticket_type" 
            readonly
            placeholder="Akan terisi otomatis"
        >
    </div>

    <div class="form-group">
        <label for="jumlah_tiket">Jumlah Tiket</label>
        <input 
            type="number" 
            id="jumlah_tiket" 
            name="jumlah_tiket" 
            min="1" 
            max="10" 
            required
            placeholder="Masukkan jumlah tiket"
        >
    </div>

    <div class="form-group">
        <label for="harga">Harga Tiket Satuan</label>
        <input 
            type="text" 
            id="harga" 
            name="harga" 
            readonly
            placeholder="Harga akan dihitung otomatis"
        >
    </div>

    <div class="voucher-section">
        <div class="form-group">
            <label for="voucher_code">Kode Voucher (Opsional)</label>
            <div style="display: flex;">
                <input 
                    type="text" 
                    id="voucher_code" 
                    name="voucher_code" 
                    placeholder="Masukkan kode voucher"
                    style="flex-grow: 1; margin-right: 10px;"
                >
                <button type="button" id="apply-voucher">Gunakan</button>
            </div>
        </div>
        <div id="voucher-result"></div>
    </div>

    <div class="form-group">
        <label for="subtotal_harga">Total Harga</label>
        <input 
            type="text" 
            id="subtotal_harga" 
            name="subtotal_harga" 
            readonly
            placeholder="Total akan dihitung otomatis"
        >
    </div>

    <button type="submit" id="submit-booking">Pesan Tiket</button>
</form>

        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="confirmation-details">
                        <div class="confirmation-row">
                            <div class="confirmation-label">Tanggal Kunjungan:</div>
                            <div class="confirmation-value" id="confirm-date"></div>
                        </div>
                        <div class="confirmation-row">
                            <div class="confirmation-label">Jenis Tiket:</div>
                            <div class="confirmation-value" id="confirm-type"></div>
                        </div>
                        <div class="confirmation-row">
                            <div class="confirmation-label">Jumlah Tiket:</div>
                            <div class="confirmation-value" id="confirm-quantity"></div>
                        </div>
                        <div class="confirmation-row">
                            <div class="confirmation-label">Harga Satuan:</div>
                            <div class="confirmation-value" id="confirm-price"></div>
                        </div>
                        <div class="confirmation-row">
                            <div class="confirmation-label">Voucher:</div>
                            <div class="confirmation-value" id="confirm-voucher"></div>
                        </div>
                        <div class="confirmation-row" style="border-bottom: none;">
                            <div class="confirmation-label" style="font-weight: bold;">Total Harga:</div>
                            <div class="confirmation-value" style="font-weight: bold;" id="confirm-total"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-custom-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn-custom-primary" id="confirm-booking">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('bookingForm');
    const bookingDateInput = document.getElementById('booking_date');
    const ticketTypeInput = document.getElementById('ticket_type');
    const jumlahTiketInput = document.getElementById('jumlah_tiket');
    const hargaInput = document.getElementById('harga');
    const subtotalHargaInput = document.getElementById('subtotal_harga');
    const voucherCodeInput = document.getElementById('voucher_code');
    const applyVoucherButton = document.getElementById('apply-voucher');
    const voucherResultDiv = document.getElementById('voucher-result');

    let currentUnitPrice = 0;
    let currentDiscount = 0;
    let discountedAmount = 0;

    const determineTicketType = (dateString) => {
        const date = new Date(dateString);
        const isWeekend = [0, 6].includes(date.getDay());
        return {
            type: isWeekend ? 'weekend' : 'weekday',
            name: isWeekend ? 'Tiket Akhir Pekan' : 'Tiket Hari Kerja'
        };
    };

    const fetchTicketPrice = async (ticketType) => {
        try {
            const response = await fetch(`/tickets/price?ticket_type=${ticketType}`);
            const data = await response.json();
            if (data.success) return parseFloat(data.price);
            throw new Error(data.message || 'Gagal mendapatkan harga tiket');
        } catch (err) {
            alert(err.message);
            return null;
        }
    };

    const applyVoucher = async () => {
        const voucherCode = voucherCodeInput.value.trim();
        if (!voucherCode) {
            voucherResultDiv.innerHTML = '<p style="color:red;">Harap masukkan kode voucher</p>';
            return;
        }

        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        if (!bookingDateInput.value || jumlahTiket < 1 || !currentUnitPrice) {
            voucherResultDiv.innerHTML = '<p style="color:red;">Isi form pemesanan terlebih dahulu</p>';
            return;
        }

        const totalHarga = currentUnitPrice * jumlahTiket;

        try {
            const response = await fetch('/vouchers/validate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    voucher_code: voucherCode,
                    total_amount: totalHarga
                })
            });

            const data = await response.json();

            if (!data.success) {
                voucherResultDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
                return;
            }

            currentDiscount = data.discount_percentage;
            discountedAmount = data.discounted_amount;

            voucherResultDiv.innerHTML = `<p style="color:green;">Voucher berhasil digunakan! Diskon ${currentDiscount}%</p>`;
            subtotalHargaInput.value = `Rp ${discountedAmount.toLocaleString('id-ID')}`;

        } catch (err) {
            voucherResultDiv.innerHTML = '<p style="color:red;">Terjadi kesalahan saat memvalidasi voucher</p>';
            console.error(err);
        }
    };

    const updateHargaDisplay = () => {
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        if (!currentUnitPrice || jumlahTiket < 1) return;

        const total = currentUnitPrice * jumlahTiket;
        discountedAmount = currentDiscount > 0 ? total * (1 - currentDiscount / 100) : total;

        hargaInput.value = `Rp ${currentUnitPrice.toLocaleString('id-ID')}`;
        subtotalHargaInput.value = `Rp ${discountedAmount.toLocaleString('id-ID')}`;
    };

    const calculateTotal = async () => {
        if (!bookingDateInput.value) return;

        const ticketInfo = determineTicketType(bookingDateInput.value);
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;

        ticketTypeInput.value = ticketInfo.name;

        const price = await fetchTicketPrice(ticketInfo.type);
        if (price === null) return;

        currentUnitPrice = price;
        currentDiscount = 0;
        discountedAmount = price * jumlahTiket;

        updateHargaDisplay();
    };

    const submitOrder = async () => {
        const ticketInfo = determineTicketType(bookingDateInput.value);
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        const voucherCode = voucherCodeInput.value.trim();

        const requestData = {
            booking_date: bookingDateInput.value,
            ticket_type: ticketInfo.type,
            jumlah_tiket: jumlahTiket,
            voucher_code: voucherCode || null,
            total_harga: discountedAmount
        };

        try {
            const response = await fetch('/tickets/order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            const result = await response.json();
            if (!response.ok) throw new Error(result.message || 'Gagal memproses pemesanan');

            Swal.fire({ title: 'Pemesanan Berhasil!', icon: 'success' }).then(() => {
                form.reset();
                ticketTypeInput.value = '';
                hargaInput.value = '';
                subtotalHargaInput.value = '';
                voucherResultDiv.innerHTML = '';
                window.location.href = '/history';
            });
            

        } catch (err) {
            Swal.fire({ title: 'Error!', text: err.message, icon: 'error' });
        }
    };

    // Event bindings
    bookingDateInput.addEventListener('change', calculateTotal);
    jumlahTiketInput.addEventListener('input', calculateTotal);
    applyVoucherButton.addEventListener('click', applyVoucher);

    form.addEventListener('submit', e => {
        e.preventDefault();
        if (!bookingDateInput.value || parseInt(jumlahTiketInput.value) < 1) {
            alert('Isi semua data pemesanan terlebih dahulu');
            return;
        }

        document.getElementById('confirm-date').textContent = formatDate(bookingDateInput.value);
        document.getElementById('confirm-type').textContent = ticketTypeInput.value;
        document.getElementById('confirm-quantity').textContent = jumlahTiketInput.value;
        document.getElementById('confirm-price').textContent = hargaInput.value;
        document.getElementById('confirm-voucher').textContent = voucherCodeInput.value || '-';
        document.getElementById('confirm-total').textContent = subtotalHargaInput.value;

        $('#confirmationModal').modal('show');
    });

    document.getElementById('confirm-booking').addEventListener('click', submitOrder);

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    };
});
</script>


    @include('components.footer')
    @include('components.scripts')

</body>
</html>