<x-intern-layout-app>
    @section('title', 'Unit')
    <x-intern-layout-header judul='Unit/Subsidiaries'></x-intern-layout-header>

    <div class="container p-3 mt-3">
        <div>
            <div class="card mb-3">
                <img class="card-img-top"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5G2gSz4-eX9c_OQ1mTqBwMLHdJ2YplSY0Vg&s"
                    alt="Card image cap" style="height: 6rem;">
                <div class="card-body">
                    <h5 class="card-title">Telkom Indonesia Witel Sumbar-Jambi</h5>
                    <p class="card-text">Saat ini memiliki 7 Unit is a wider card with supporting text below as a
                        natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>

            <!-- Card 1 -->
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="https://awsimages.detik.net.id/community/media/visual/2022/10/29/ilustrasi-desain-kantor.jpeg?w=1200"
                            class="img-fluid rounded-start me-3" alt="Image" style="width: 50px; height: 50px;">
                        <span>Shared Service & General Support</span>
                    </div>
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCard1" aria-expanded="false" aria-controls="collapseCard1">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>

                <div id="collapseCard1" class="collapse">
                    <div class="card-body">
                        <p><strong>Ketua/Penanggung Jawab:</strong> Ani Wijaya<br>
                            <strong>Lokasi Ruangan:</strong> Lantai 1, Gedung Utama
                        </p>
                        <hr class="my-2">
                        <p class="text-justify">
                            Shared Service & General Support bertanggung jawab atas pemastian tingkat kecukupan dukungan
                            anggaran dan financial secara efektif dan efisien, efektivitas pengelolaan fungsi payment
                            collection, tingkat produktivitas SDM termasuk pengalokasiannya, pelaksanaan pengelolaan
                            tanggung jawab sosial & lingkungan (TJSL) dan rumah BUMN, learning event area, dan fungsi
                            information system dan cyber security dalam mendukung pencapaian target dan program utama
                            Telkom di lingkup geografis Regional yang dikelola.
                        </p>
                        <p class="mt-2 text-justify">
                            Selain itu, unit ini juga bertanggung jawab atas pelaksanaan dan kelancaran berbagai
                            aktivitas pendukung penyelenggaraan operasional program-program bisnis, khususnya dalam
                            aspek-aspek yang terkait dengan public relation, asset and facility management, serta
                            security and safety.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="https://www.kantorkita.co.id/blog/wp-content/uploads/2022/10/Mengenal-Tata-Ruang-Kantor-dan-Jenisnya.jpg"
                            class="img-fluid rounded-start me-3" alt="Image" style="width: 50px; height: 50px;">
                        <span>Regional Solution & Operation</span>
                    </div>
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCard2" aria-expanded="false" aria-controls="collapseCard2">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>

                <div id="collapseCard2" class="collapse">
                    <div class="card-body">
                        <p><strong>Ketua/Penanggung Jawab:</strong> Budi Santoso</p>
                        <p><strong>Lokasi Ruangan:</strong> Lantai 2, Gedung Utama</p>
                        <p class="mt-2 text-justify">
                            Regional Solution & Operation bertanggung jawab atas pemastian tingkat kecukupan dukungan
                            operasional dan solusi-solusi bisnis di tingkat regional.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" class="img-fluid rounded-start me-3" alt="Image"
                            style="width: 50px; height: 50px;">
                        <span>Another Unit</span>
                    </div>
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCard3" aria-expanded="false" aria-controls="collapseCard3">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="collapseCard3" class="collapse">
                    <div class="card-body">
                        <p>Unit ini bertanggung jawab atas ...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-intern-layout-app>
