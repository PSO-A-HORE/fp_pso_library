@extends('layouts.app')

@section('body')
    <div class="container">
        <h1 class="title">Welcome to Library</h1>

        <!-- Form untuk input name dan NRP -->
        <form id="dataForm" class="form-container">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="nrp">NRP:</label>
                <input type="text" id="nrp" name="nrp" required>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-button">Kirim</button>
            </div>
        </form>

        <!-- Div untuk menampilkan pesan -->
        <div id="message" class="message"></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataForm').on('submit', function (e) {
                e.preventDefault(); // Mencegah reload halaman

                // Ambil data dari form
                let name = $('#name').val();
                let nrp = $('#nrp').val();
                let errorMessage = '';

                // Validasi frontend
                if (!/^[a-zA-Z\s]+$/.test(name)) {
                    errorMessage += '<div>Kolom <strong>Name</strong> hanya boleh berisi huruf.</div>';
                }
                if (!/^\d+$/.test(nrp)) {
                    errorMessage += '<div>Kolom <strong>NRP</strong> hanya boleh berisi angka.</div>';
                }
                // Periksa panjang NRP jika diperlukan (misalnya 10 digit)
                if (nrp.length !== 10) {
                    errorMessage += '<div>Kolom <strong>NRP</strong> harus terdiri dari 10 digit.</div>';
                }

                // Jika ada error, tampilkan di elemen `div` message
                if (errorMessage) {
                    $('#message').html(errorMessage).css({
                        color: "red",
                        background: "#ffe6e6",
                        padding: "10px",
                        border: "1px solid red",
                        borderRadius: "5px",
                    });
                    return; // Stop jika ada error
                }

                // Kirim data dengan AJAX
                $.ajax({
                    url: "{{ route('submitForm') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        nrp: nrp
                    },
                    success: function (response) {
                        $('#message').html('<div>' + response.message + '</div>').css({
                            color: "green",
                            background: "#e6ffe6",
                            padding: "10px",
                            border: "1px solid green",
                            borderRadius: "5px",
                        });
                        $('#dataForm')[0].reset(); // Reset form
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            // Validasi error dari Laravel
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            if (errors.name) {
                                errorMessage += '<div>Name: ' + errors.name[0] + '</div>';
                            }
                            if (errors.nrp) {
                                errorMessage += '<div>NRP: ' + errors.nrp[0] + '</div>';
                            }
                            $('#message').html(errorMessage).css({
                                color: "red",
                                background: "#ffe6e6",
                                padding: "10px",
                                border: "1px solid red",
                                borderRadius: "5px",
                            });
                        } else {
                            // Jika ada error lain
                            $('#message').html('<div>Terjadi kesalahan. Silakan coba lagi.</div>').css({
                                color: "red",
                                background: "#ffe6e6",
                                padding: "10px",
                                border: "1px solid red",
                                borderRadius: "5px",
                            });
                        }
                    }
                });
            });
        });
    </script>



    <!-- Tambahkan CSS -->
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group label {
            flex: 1;
            font-weight: bold;
            font-family: Arial, sans-serif;
            color: #555;
        }

        .form-group input {
            flex: 2;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
        }
    </style>
@endsection
