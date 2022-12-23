@extends('layouts.main')
@section('main-content')

<div class="row justify-content-center mt-5">
    <h2 class="text-center font-semibold mt-5">Tentang Toko</h2>
    <div class="col-md-10 mt-3">
        <div class="mt-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-8 m-auto p-auto">
                    <p>
                        Z-Book's didirikan pada tahun 2020 untuk menyediakan buku dan majalah impor berkualitas tinggi kepada pembaca di Indonesia.
                        Selama bertahun-tahun, jaringan kami telah berkembang dan kami sekarang memiliki lebih dari 45 gerai ritel di area
                        perbelanjaan strategis di seluruh Indonesia termasuk bandara dan mal. Memungkinkan Anda memilih dari lebih dari 21 juta
                        buku dan majalah internasional dengan pengiriman cepat, terjamin, dan harga murah.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/about-us.jpg') }}" alt="about owner"
                        class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10 mt-3">
        <div class="mt-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/owner.jpg') }}" alt="about owner"
                        class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8 m-auto p-auto">
                    <div class="card-body">
                        <h5 class="font-semibold card-title mb-3">Ahmad Zuhril Fahrizal (Owner Toko)</h5>
                        <p class="card-text">
                            halo, nama saya Ahmad Zuhril Fahrizal. saya pelaku usaha di bidang penjualan buku untuk semua pelajar atau mahasiswa. Omzet per bulan yang saya dapatkan bisa
                            mencapai 12 juta. Plus, buku-buku di sini ditulis oleh banyak penulis terkenal dan hebat.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <div class="card-body">
                <h5 class="mb-3">Untuk bisnis anda bisa kontak melalui : </h5>
                <a href="https://www.facebook.com/ahmad.z.fahrizal.35/" class="btn btn-primary" target="blank">
                    <i class="fab fa-fw fa-facebook"></i>
                    Facebook
                </a>
                <a href="https://www.instagram.com/zuhrillfilm/" class="btn btn-danger" target="blank">
                    <i class="fab fa-fw fa-instagram"></i>
                    Instagram
                </a>
                <a href="https://wa.me/085843960995" class="btn btn-success" target="blank">
                    <i class="fab fa-fw fa-whatsapp"></i>
                    Whatsapp
                </a>
                <a href="https://www.linkedin.com/in/zuhril-fahrizal-b6a627245/" class="btn btn-dark" target="blank">
                    <i class="fab fa-fw fa-linkedin"></i>
                    Linkedin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection