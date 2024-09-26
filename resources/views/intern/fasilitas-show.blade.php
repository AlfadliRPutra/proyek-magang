<x-intern-layout-app>
<x-intern-layout-header :judul="$fasilitas['title']"></x-intern-layout-header>

    <section style="padding: 20px; background-color: #f9f9f9;">
        <div class="container" style="max-width: 700px; margin: 0 auto;">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-8 col-sm-12">
                    <div class="featured-item" style="background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                        <div class="thumb" style="position: relative;">
                            <img src="{{ asset($fasilitas['image']) }}" alt="{{ $fasilitas['title'] }}" style="width: 100%; height: auto; max-width: 100%; display: block; margin: 0 auto;">
                            @isset($fasilitas['image-pic'])
                                <div class="overlay-content" style="position: absolute; top: 10px; right: 10px;">
                                    <img src="{{ asset($fasilitas['image-pic']) }}" alt="PIC Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #fff;">
                                </div>
                            @endisset
                        </div>
                        <div class="down-content" style="padding: 20px;">
                            @isset($fasilitas['pic'])
                                <h6 style="font-size: 1rem; color: #777;">PIC: {{ $fasilitas['pic'] }}</h6>
                            @endisset
                            @isset($fasilitas['days'])
                                <span style="display: block; font-size: 0.9rem; color: #555;">{{ $fasilitas['days'] }}</span>
                            @endisset
                            @isset($fasilitas['time'])
                                <h6 style="font-size: 0.9rem; color: #555;">{{ $fasilitas['time'] }}</h6>
                            @endisset
                            <p style="margin-top: 15px; font-size: 1rem; color: #666;">{{ $fasilitas['description'] }}</p>
                            
                            @if($fasilitas['location'])
                                <div class="text-button" style="margin-top: 20px; text-align: left;">
                                    <p id="toggle-location" onclick="toggleLocation()" style="cursor: pointer; color: #007bff; font-weight: bold;">
                                        Lihat Lokasi <span id="icon">→</span>
                                    </p>
                                    <section class="contact" id="contact" style="display: none; margin-top: 20px;">
                                        <div id="map" style="width:100%; border-radius: 10px; overflow: hidden;">
                                            <iframe src="{{ $fasilitas['location'] }}" width="100%" height="400px" 
                                                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </section>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<br>
    <script>
        function toggleLocation() {
            var locationSection = document.querySelector('#contact');
            var toggleText = document.querySelector('#toggle-location');
            var icon = document.querySelector('#icon');

            if (locationSection.style.display === 'none') {
                locationSection.style.display = 'block';
                toggleText.innerHTML = 'Sembunyikan Lokasi <span id="icon"><--</span>';
            } else {
                locationSection.style.display = 'none';
                toggleText.innerHTML = 'Lihat Lokasi <span id="icon">--></span>';
            }
        }
    </script>

    <style>
        /* Media Query untuk responsif */
        @media (max-width: 768px) {
            .appHeader .pageTitle {
                font-size: 1.2rem;
            }
            .featured-item {
                margin-bottom: 20px;
            }
            .down-content h4 {
                font-size: 1.3rem;
            }
        }

        /* Hover effect */
        .featured-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        /* Animation */
        .featured-item img {
            transition: transform 0.3s ease;
        }
        .featured-item img:hover {
            transform: scale(1.05);
        }
    </style>
</x-intern-layout-app>
