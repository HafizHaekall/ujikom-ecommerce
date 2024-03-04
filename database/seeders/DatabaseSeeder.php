<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'id' => 1,
            'photo' => 'user/hafiz.jpg',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'photo' => 'user/rpl.png',
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user1234'),
            'is_admin' => false
        ]);

        $products = [
            ['products/pin.jpg', 'Pin', 'Tambahkan sedikit kilauan pada pakaian Anda dengan Pin kami!  Dengan berbagai desain yang unik, pin ini adalah aksesoris yang serbaguna dan bisa Anda kenakan dengan bangga di mana saja.', 5000, 50],
            ['products/gk_1s.jpg', 'Ganci 1 sisi', 'Gantungan kunci sederhana namun efektif! Ganci 1 sisi kami adalah pilihan yang sempurna untuk menjaga kunci Anda tetap aman. Kecil, ringan, dan praktis!', 5000, 50],
            ['products/gk_akrilik.jpg', 'Ganci Akrilik', 'Bawa kehidupan Anda lebih dekat dengan Ganci Akrilik kami! Dengan desain yang transparan dan elegan, gantungan kunci akrilik ini adalah aksesoris sempurna untuk tas Anda.', 5000, 50],
            ['products/kaos_sm.jpg', 'Kaos Pendek Polyester', 'Tetap nyaman dan modis dengan Kaos Pendek Polyester kami.  Terbuat dari bahan polyester yang ringan dan tahan lama, kaos ini adalah pilihan yang sempurna untuk sehari-hari. Tersedia dalam berbagai ukuran dan warna!', 50000, 50],
            ['products/mug_polos.jpg', 'Mug Polos', 'Buat pagi Anda lebih cerah dengan Mug Polos kami. ☕ Kustomisasi mug ini dengan gambar atau pesan pribadi Anda untuk memberikan sentuhan pribadi pada setiap tegukan kopi. Pagi yang indah dimulai dari sini!', 25000, 50],
            ['products/mug_warna.jpg', 'Mug Warna', 'Warnai harimu dengan Mug Warna kami! ☕ Dengan berbagai pilihan warna cerah, Anda dapat memilih mug yang sesuai dengan suasana hati Anda. Minum kopi belum pernah semenyenangkan ini!', 27000, 50],
            ['products/tblr_sm.jpg', 'Tumbler Kecil', 'Tetap segar dan hidrasi dengan Tumbler Kecil kami.  Didesain untuk mobilitas Anda, tumbler kecil ini memungkinkan Anda minum dengan mudah kapan saja, di mana saja. Kecil namun kuat!', 25000, 50],
            ['products/tblr_lg.jpg', 'Tumbler Besar', 'Tumbler Besar kami adalah teman minum yang sempurna untuk petualangan Anda!  Dengan kapasitas yang lebih besar, Anda dapat mengisi lebih banyak minuman untuk menjaga diri Anda tetap terhidrasi selama perjalanan. Lepaskan jiwa petualangan Anda!', 30000, 50],
            ['products/tb_kanvas.jpg', 'Totebag Kanvas', 'Totebag Kanvas kami adalah perpaduan sempurna antara gaya dan fungsi.  Terbuat dari kanvas yang kokoh, totebag ini akan menemani Anda dalam perjalanan berbelanja atau saat berkeliling kota. Ekspresikan gaya Anda dengan totebag yang fleksibel ini!', 25000, 50],
            ['products/tb_blacu.jpg', 'Totebag blacu', 'Tampil trendi dan berkeliling dengan Totebag blacu kami!  Terbuat dari bahan blacu yang tahan lama, totebag ini adalah teman setia Anda untuk berbelanja atau pergi ke kampus. Buat penampilan Anda unik dengan totebag yang nyaman ini.', 22000, 50],
            ['products/tb_hitam_1.jpg', 'Totebag hitam', 'Tampil klasik dan berkelas dengan Totebag Hitam kami! Terbuat dari bahan berkualitas tinggi yang tahan lama dengan desain yang sederhana namun elegan, totebag ini adalah pilihan sempurna untuk melengkapi gaya Anda dalam segala kegiatan.', 35000, 50],
            ['products/tb_hitam.jpg', 'Totebag hitam desain 1/2', 'Totebag Hitam Desain 1/2 kami adalah paduan antara gaya klasik dan sentuhan modern. Terbuat dari bahan berkualitas tinggi, totebag ini menjadi pilihan yang tepat untuk tampil berbeda.', 30000, 50],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product[1],
                'price' => $product[3],
                'description' => $product[2],
                'image' => $product[0],
                'stock' => $product[4],
            ]);
        }
    }
}
