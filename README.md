##Perbaikan Kode Program Yoga

Pada sistem yang dibuat oleh Yoga tidak melakukan pengecekan role menggunakan middleware setelah login, sehingga semua pengguna dapat mengakses halaman admin tanpa batasan.
Di kode juga tidak menggunakan hash untuk menyimpan password user agar tidak terjadi kebocoran data.
