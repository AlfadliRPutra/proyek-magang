<x-intern-layout-app>
    @section('title','Presensi')
    @section('header')
    <div class="appHeader text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    </div>
    <div class="container">
        <h1>Presensi Wajah</h1>
        <div class="video-container">
            <div class="video-frame">
                <video id="video" autoplay></video>
            </div>
        </div>
        <img id="captured-image" src="" alt="Foto Hasil" />
        <button id="take-photo">Ambil Foto</button>
        <div class="loading">
            <img src="https://i.imgur.com/llF5iyg.gif" alt="Loading..."/>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const capturedImage = document.getElementById('captured-image');
        const takePhotoButton = document.getElementById('take-photo');
        const loading = document.querySelector('.loading');

        // Akses kamera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => console.error("Error accessing camera: ", err));

        // Fungsi untuk ambil foto
        takePhotoButton.addEventListener('click', function() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Tampilkan gambar hasil di img tag
            const imageData = canvas.toDataURL('image/png');
            capturedImage.src = imageData;
            capturedImage.style.display = 'block';
            loading.style.display = 'block'; // Tampilkan animasi loading

            // Kirim data gambar ke server menggunakan AJAX
            fetch('/submit-presensi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    image: imageData
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                loading.style.display = 'none'; // Sembunyikan animasi loading setelah selesai
                alert('Presensi berhasil disimpan!');
            })
            .catch(err => {
                loading.style.display = 'none';
                console.error('Error:', err);
            });
        });
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: white;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 450px;
            margin: 70px auto;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #333;
            background: -webkit-linear-gradient(#007bff, #00d2ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-top: 75%;
            margin-bottom: 20px;
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
        }

        .video-frame {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 5px;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: inset 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        img {
            display: none;
            width: 100%;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        button {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
        }

        button:hover {
            background-color: #e64a19;
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px);
        }

        .loading {
            display: none;
            margin-top: 20px;
        }

        .loading img {
            width: 50px;
            height: 50px;
        }
    </style>
</x-intern-layout-app>
