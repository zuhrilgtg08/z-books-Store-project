<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'nama_author' => 'Raditya Dika',
            'slug' => 'raditya-dika-1',
            'image' => Null,
            'excerpt' => 'Dika Angkasaputra Moerwani Nasution, yang mengubah...',
            'biografi_author' => 'Dika Angkasaputra Moerwani Nasution, yang mengubah namanya menjadi Raditya Dika Angkasaputra Moerwani Nasution (lahir 28 Desember 1984) adalah seorang komedian, penulis, sutradara, produser, penulis skenario, pebisnis, YouTuber, dan aktor Indonesia. Buku pertamanya berjudul Kambing Jantan masuk kategori best seller. Buku tersebut menampilkan kehidupan Dika (Raditya Dika) saat kuliah di Australia. Tulisan pria yang akrab disebut Radit ini bisa digolongkan sebagai genre baru. Kala ia merilis buku pertamanya tersebut, memang belum banyak yang masuk ke dunia tulisan komedi. Apalagi bergaya diari pribadi (personal essay). Raditya Dika menikah dengan Anissa Aziza pada 5 Mei 2018 lalu. Setahun menjalani pernikahan sebagai sepasang suami istri, pada 6 Mei 2019, Annisa Aziza melahirkan seorang putri yang diberi nama Alinea Ava Nasution.'
        ]);

        Author::create([
            'nama_author' => 'Tere Liye',
            'slug' => 'tere-liye-2',
            'image' => Null,
            'excerpt' => 'Tere Liye menikah dengan Riski Amelia. Dari pernik...',
            'biografi_author' => 'Tere Liye menikah dengan Riski Amelia. Dari pernikahan tersebut, ia dikaruniai dua orang anak yang bernama Abdullah Pasai dan Faizah Azkia. Tere Liye pernah memberikan keterangan kepada Syahrudin dari Republika Penerbit terkait keengganan menjadi sosok terkenal serta mengumbar kehidupan pribadinya di media sosial. Tere Liye lebih ingin dikenal melalui karya-karyanya. Tere Liye tidak ingin banyak orang tahu siapa sosok aslinya.'
        ]);

        Author::create([
            'nama_author' => 'Eiichiro Oda',
            'slug' => 'eiichiro-oda-3',
            'image' => Null,
            'excerpt' => 'Saat kecil, Oda selalu berangan-angan sebagai...',
            'biografi_author' => 'Saat kecil, Oda selalu berangan-angan sebagai bajak laut dan ingin menjadi mangaka. Pada umur 17 tahun, Oda mengirimkan karyanya berjudul Wanted dan memenangkan berbagai penghargaan. Pada umur 19 tahun, Oda menjadi asisten Nobuhiro Watsuki dalam pengerjaan Rurouni Kenshin. Bersamaan dengan itu pula, Oda menggambar Romance Dawn yang merupakan bab awal dari One Piece. Pada tahun 1997, One Piece terbit pertama kali di majalah Shonen Jump dan menjadi salah satu manga terpopuler di Jepang. Manga One Piece ini pun menjadi manga terpopuler di seluruh dunia.'
        ]);

        Author::create([
            'nama_author' => 'Masashi Kishimoto',
            'slug' => 'masashi-kishimoto-4',
            'image' => Null,
            'excerpt' => 'Masashi Kishimoto lahir di Katsuta, Prefektur Okayama...',
            'biografi_author' => 'Masashi Kishimoto lahir di Katsuta, Prefektur Okayama, Jepang pada 8 November 1974. Kishimoto mulai mengembangkan bakat menggambarnya sejak duduk di bangku SD. Kishimoto lahir sebagai anak kembar. Kishimoto menyebut pembuat serial manga terkenal Dr. Slump dan Dragon Ball, Akira Toriyama, sangat mempengaruhi dirinya. Kishimoto juga mengaku serial manga dan anime berjudul Akira karya Katsuhiro Otomo turut memberi pengaruh atas karya-karyanya. Ketika belum sekolah ia sangat senang menonton Doraemon'
        ]);
    }
}