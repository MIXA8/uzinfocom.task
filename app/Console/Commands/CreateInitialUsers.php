<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateInitialUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-initial-users
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает 1 Админа, 1 Модератора и 2 Обычных Пользователей';

    /**
     * Execute the console command.
     */
    public function handle()
    {$this->info('Создание пользователей с ролями...');

        // Админ
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => Role::ADMIN->value,
        ]);
        $this->info('Админ создан: admin@example.com / password123');

        // Модератор
        User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password123'),
            'role_id' => Role::MODERATOR->value,
        ]);
        $this->info('Модератор создан: moderator@example.com / password123');

        // Обычные пользователи
        User::create([
            'name' => 'User One',
            'email' => 'user1@example.com',
            'password' => Hash::make('password123'),
            'role_id' => Role::USER->value,
        ]);
        User::create([
            'name' => 'User Two',
            'email' => 'user2@example.com',
            'password' => Hash::make('password123'),
            'role_id' => Role::USER->value,
        ]);
        $this->info('Обычные пользователи созданы: user1@example.com, user2@example.com / password123');

        $this->info('Все пользователи успешно созданы!');
        return CommandAlias::SUCCESS;
    }
}
