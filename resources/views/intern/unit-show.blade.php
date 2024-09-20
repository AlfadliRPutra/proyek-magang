<x-intern-layout-app>

    @push('scipts')
        <!-- Include your CSS files -->
        <link rel="stylesheet" href="{{ asset('venue/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/fontAwesome.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/hero-slider.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/owl-carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('venue/css/templatemo-style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link href="https://fonts.googleapis.com/css?family=public+sans:100,200,300,400,500,600,700,800,900"
            rel="stylesheet">

        <script src="{{ asset('venue/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    @endpush
    @section('title', 'Dashboard')
    <div class="appHeader text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Unit Telkom</div>
        <div class="right"></div>
    </div>
    <section class="featured-places" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="featured-item">
                        <div class="thumb">
                            <img src="{{ asset($unit['image']) }}" alt="{{ $unit['title'] }}" style="width: 100%;">
                            @isset($unit['image-pic'])
                                <div class="overlay-content">
                                    <!-- Add other overlay content if needed -->
                                </div>
                                <div class="date-content">
                                    <img src="{{ asset($unit['image-pic']) }}" alt="Gambar"
                                        style="width: 100%; height: auto; border-radius: 5px solid black;">
                                </div>
                            @endisset
                        </div>
                        <div class="down-content">
                            <h4>{{ $unit['title'] }}</h4>
                            @isset($unit['pic'])
                                <h6>PIC: {{ $unit['pic'] }}</h6>
                            @endisset
                            @isset($unit['days'])
                                <span>{{ $unit['days'] }}</span>
                            @endisset
                            @isset($unit['time'])
                                <h6>{{ $unit['time'] }}</h6>
                            @endisset
                            <p>{{ $unit['description'] }}</p>
                            <div class="text-button">
                                <a href="{{ url('/venue/tenis_lap_lok.html') }}">Lihat Lokasi -></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="lok">
        <h2>Lokasi</h2>
    </div>
    <section class="contact" id="contact">
        <div id="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d713.6541925354467!2d103.59580064589498!3d-1.6099023640546177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588f356122a4d%3A0x1f2ec666b2d841e0!2sJl.%20Sumantri%20Brojonegoro%20No.54%2C%20Sungai%20Putri%2C%20Kec.%20Telanaipura%2C%20Kota%20Jambi%2C%20Jambi%2036124!5e1!3m2!1sid!2sid!4v1722561982449!5m2!1sid!2sid"
                width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <br>
    <p></p>
    <br>
    <P></P>
    <br>
    <P></P>
</x-intern-layout-app>
