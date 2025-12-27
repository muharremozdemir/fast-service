<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Mevcut veritabanı yedeği seeder'ları (iseed ile oluşturulmuş)
        // Önce bağımlılıkları, sonra diğerlerini ekle
        
        // 1. Temel tablolar (bağımlılık yok)
        $this->call(CompaniesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        
        // 2. Kullanıcılar (companies'e bağımlı)
        $this->call(UsersTableSeeder::class);
        
        // 3. Role ve permission ilişkileri (users, roles, permissions'a bağımlı)
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        
        // 4. Diğer tablolar (companies'e bağımlı)
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(FloorsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(QrStickersTableSeeder::class);
        
        // 5. Orders (rooms, products, companies'e bağımlı)
        $this->call(OrderSeeder::class);
        
        // Eski seeder'lar (isteğe bağlı - yukarıdaki seeder'lar mevcut verileri içeriyor)
        // $this->call(AdminSeeder::class);
        // $this->call(CompanySeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(StaffSeeder::class);
        // $this->call(FloorRoomSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(CartItemsTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OtpCodesTableSeeder::class);
    }
}
