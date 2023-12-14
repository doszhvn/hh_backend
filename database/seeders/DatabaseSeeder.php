<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\CV;
use App\Models\EmploymentType;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\VacancyReply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'password'=>'$2y$10$sWRADT1FX7IACEdAbsfa2O05nJgqd88bA/lfJuS.8DFiRcXaPv2eO',
            'role'=>'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'HR',
            'email' => 'hr@hr.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role'=>'moderator'
        ]);
        User::factory(8)->create();
        Category::insert([
            ['name' => 'Разработка'],
            ['name' => 'Дизайн'],
            ['name' => 'Продажи'],
            ['name' => 'Поддержка клиентов'],
            ['name' => 'Менеджмент'],
            ['name' => 'Маркетинг'],
        ]);
        EmploymentType::insert([
            ['name' => 'Полная занятость'],
            ['name' => 'Проектная работа'],
            ['name' => 'Частичная занятость'],
            ['name' => 'Волонтерство'],
            ['name' => 'Стажировка'],
        ]);
        Vacancy::factory(10)->create();
        CV::factory(10)->create();
        VacancyReply::factory(10)->create();
    }
}
