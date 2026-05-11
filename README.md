##Perbaikan Kode Program Yoga

Pada sistem yang dibuat oleh Yoga tidak melakukan pengecekan role menggunakan middleware setelah login, sehingga semua pengguna dapat mengakses halaman admin tanpa batasan.
Di kode juga tidak menggunakan hash untuk menyimpan password user agar tidak terjadi kebocoran data.

Kode yang dibuat Yoga akan sangat berbahaya karna tidak adanya perlindungan yang dibuat.
dampaknya jika dibiarkan data bisa saja bocor ke pihak yang tidak bertanggung jawab dan akan di salah gunakan.
