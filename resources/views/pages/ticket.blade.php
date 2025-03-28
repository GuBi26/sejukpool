<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket</title>
    <style>
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
            color: white
        }
        .booking-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 40px auto;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px
        }
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
        #voucher-result p {
            margin-top: 8px;
            font-size: 14px;
            font-weight: bold;
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
                    <h1>Syarat & Ketentuan</h1>
                    <div class="breadcrumbs">
                        <a href="index.html">Beranda</a>
                        <i class="fa fa-angle-double-right"></i>
                        <span>Syarat & Ketentuan</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="booking-container">
        <div class="top-head">
            <h1>Pemesanan Tiket</h1>
        </div>
        <form id="bookingForm">
            <div class="form-group">
                <label for="type">Jenis Tiket</label>
                <select id="type" name="type" required>
                    <option value="">Pilih Jenis Tiket</option>
                    <option value="weekday">Tiket Hari Kerja</option>
                    <option value="weekend">Tiket Akhir Pekan</option>
                </select>
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
                <label for="harga">Harga Tiket</label>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ticketPrices = {
                weekday: 50000,
                weekend: 75000
            };

            const form = document.getElementById('bookingForm');
            const typeSelect = document.getElementById('type');
            const jumlahTiketInput = document.getElementById('jumlah_tiket');
            const hargaInput = document.getElementById('harga');
            const subtotalHargaInput = document.getElementById('subtotal_harga');
            const voucherCodeInput = document.getElementById('voucher_code');
            const applyVoucherButton = document.getElementById('apply-voucher');
            const voucherResultDiv = document.getElementById('voucher-result');

            function calculateTotal() {
                const type = typeSelect.value;
                const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;

                if (type && jumlahTiket > 0) {
                    const unitPrice = ticketPrices[type];
                    const total = unitPrice * jumlahTiket;

                    hargaInput.value = `Rp ${unitPrice.toLocaleString()}`;
                    subtotalHargaInput.value = `Rp ${total.toLocaleString()}`;
                } else {
                    hargaInput.value = '';
                    subtotalHargaInput.value = '';
                }
            }

            typeSelect.addEventListener('change', calculateTotal);
            jumlahTiketInput.addEventListener('input', calculateTotal);

            applyVoucherButton.addEventListener('click', function() {
                const voucherCode = voucherCodeInput.value.trim();
                
                if (voucherCode === 'DISKON10') {
                    let currentTotal = parseFloat(subtotalHargaInput.value.replace('Rp ', '').replace(/\./g, '')) || 0;
                    
                    if (currentTotal > 0) {
                        const discountedTotal = currentTotal * 0.9;
                        voucherResultDiv.innerHTML = '<p style="color: green;">Voucher berhasil digunakan!</p>';
                        subtotalHargaInput.value = `Rp ${discountedTotal.toLocaleString()}`;
                    }
                } else {
                    voucherResultDiv.innerHTML = '<p style="color: red;">Kode voucher tidak valid.</p>';
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Pemesanan berhasil! Terima kasih telah membeli tiket.');
            });
        });
    </script>

    @include('components.footer')
    @include('components.scripts')

</body>
</html>
