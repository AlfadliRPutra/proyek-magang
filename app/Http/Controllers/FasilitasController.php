<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function show($nama_fasilitas)
{
    $fasilitas = [
        'mushola' => [
        'title' => 'Mushola',
        'description' => 'Mushola ini menyediakan ruang ibadah yang nyaman dan tenang bagi karyawan dan peserta magang, dilengkapi dengan tempat wudhu dan perlengkapan shalat yang bersih.',
        'image' => 'https://sman1mirit.sch.id/assets/img/sarpras/46161694212fbc0edd9f82f8a365904c.jpeg',
        'pic' => null,
        'days' => null,
        'time' => null,
        'location' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d678.8453164862916!2d103.59576584335767!3d-1.6102312472599203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMzYnMzguMCJTIDEwM8KwMzUnNDQuNSJF!5e1!3m2!1sid!2sid!4v1727318251545!5m2!1sid!2sid', // URL Google Maps embed
],


        'gym' => [
            'title' => 'Gym',
            'description' => 'Fasilitas gym yang dilengkapi dengan peralatan kebugaran modern, tersedia untuk karyawan dan peserta magang yang ingin menjaga kebugaran tubuh.',
            'image' => 'https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2023/02/25/YFC-gym-1816651358.jpg',
            'pic' => 'Alex Johnson',
            'days' => 'Senin - Minggu',
            'time' => '06:00 - 22:00',
            'location' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d759.479981790268!2d103.59603432964073!3d-1.6098207896759302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMzYnMzUuMyJTIDEwM8KwMzUnNDYuNiJF!5e1!3m2!1sid!2sid!4v1727318835043!5m2!1sid!2sid', // URL Google Maps embed
        ],

        'tennis' => [
            'title' => 'Lapangan Tennis',
            'description' => 'Lapangan tenis dengan fasilitas yang lengkap untuk olahraga.',
            'image' => 'https://asset.kompas.com/crops/3EFiluNjBivGQ5tH_0Jd17w_QqE=/12x44:639x463/750x500/data/photo/2023/01/02/63b26ef489161.jpeg',
            'pic' => 'Alex Turner',
            'days' => 'Senin - Jumat',
            'time' => '16:00 - 18:00',
            'location' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d773.6152360209919!2d103.59595575887396!3d-1.6096461084144238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMzYnMzQuMiJTIDEwM8KwMzUnNDQuOSJF!5e1!3m2!1sid!2sid!4v1727318037149!5m2!1sid!2sid', // URL Google Maps embed
        ],

        'basket' => [
            'title' => 'Lapangan Basket',
            'description' => 'Lapangan basket untuk olahraga.',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4TDgKYT0UviGZWG8DiQAIycC2khaocCQLeg&s',
            'pic' => 'John Doe',
            'days' => 'Senin - Jumat',
            'time' => '16:00 - 18:00',
            'location' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d713.6541925354467!2d103.59580064589498!3d-1.6099023640546177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588f356122a4d%3A0x1f2ec666b2d841e0!2sJl.%20Sumantri%20Brojonegoro%20No.54%2C%20Sungai%20Putri%2C%20Kec.%20Telanaipura%2C%20Kota%20Jambi%2C%20Jambi%2036124!5e1!3m2!1sid!2sid!4v1722561982449!5m2!1sid!2sid',
        ],
      'badminton' => [
            'title' => 'Lapangan Badminton',
            'description' => 'Lapangan badminton untuk olahraga, tersedia bagi karyawan dan peserta magang yang ingin berolahraga di waktu luang.',
            'image' => 'https://student-activity.binus.ac.id/badminton/wp-content/uploads/sites/65/2024/01/S__13672454.jpg',
            'pic' => 'John Doe',
            'days' => 'Senin - Jumat',
            'time' => '16:00 - 18:00',
            'location' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d759.4800477139868!2d103.59570706709397!3d-1.6096438184452684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMzYnMzQuNCJTIDEwM8KwMzUnNDUuMSJF!5e1!3m2!1sid!2sid!4v1727318447513!5m2!1sid!2sid', // URL Google Maps embed
        ],


    'panahan' => [
        'title' => 'Lapangan Panahan',
        'description' => 'Tempat untuk latihan panahan yang dilengkapi dengan peralatan profesional.',
        'image' => 'https://example.com/panahan_image.jpg', // Ganti dengan link gambar yang relevan
        'pic' => 'David Johnson',
        'days' => 'Senin - Rabu',
        'time' => '14:00 - 16:00',
        'location' => null, // Tambahkan URL Google Maps jika ada
    ],

    'yoga' => [
        'title' => 'Ruang Yoga',
        'description' => 'Tempat yoga untuk meditasi dan kebugaran, dilengkapi instruktur profesional.',
        'image' => 'https://example.com/yoga_image.jpg', // Ganti dengan link gambar yang relevan
        'pic' => 'Emily Davis',
        'days' => 'Senin, Rabu, Jumat',
        'time' => '08:00 - 09:30',
        'location' => null, // Tambahkan URL Google Maps jika ada
    ],

    'sepeda' => [
        'title' => 'Trek Sepeda',
        'description' => 'Trek sepeda untuk kegiatan bersepeda di lingkungan hijau yang menyegarkan.',
        'image' => 'https://example.com/sepeda_image.jpg', // Ganti dengan link gambar yang relevan
        'pic' => 'Michael Lee',
        'days' => 'Sabtu - Minggu',
        'time' => '06:00 - 08:00',
        'location' => null, // Tambahkan URL Google Maps jika ada
    ],
    'tenislapangan' => [
        'title' => 'Lapangan Tenis',
        'description' => 'Lapangan tenis yang luas dan nyaman untuk bermain tenis bersama teman atau keluarga.',
        'image' => 'https://example.com/tenis_lapangan_image.jpg', // Ganti dengan link gambar yang relevan
        'pic' => 'Sarah Johnson',
        'days' => 'Senin - Minggu',
        'time' => '08:00 - 20:00',
        'location' => null, // Tambahkan URL Google Maps jika ada
    ],
    'kantin' => [
        'title' => 'Kantin',
        'description' => 'Kantin yang menyediakan berbagai makanan dan minuman untuk memenuhi kebutuhan energi Anda.',
        'image' => 'https://example.com/kantin_image.jpg', // Ganti dengan link gambar yang relevan
        'pic' => 'Emily Davis',
        'days' => 'Senin - Minggu',
        'time' => '07:00 - 20:00',
        'location' => null, // Tambahkan URL Google Maps jika ada
    ],



        // Tambahkan fasilitas lain seperti badminton, panahan, yoga, sepeda di sini
    ];
    

    // Cek apakah fasilitas yang diminta ada di array
    if (!array_key_exists($nama_fasilitas, $fasilitas)) {
        abort(404);  // Tampilkan halaman 404 jika fasilitas tidak ditemukan
    }

    $fasilitas = $fasilitas[$nama_fasilitas];
    $judul = $fasilitas['title'];  // Mengambil judul fasilitas untuk header

    // Tampilkan view dan kirim data ke view
    return view('intern.fasilitas-show', compact('fasilitas', 'judul'));
}

}