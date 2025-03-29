<?php

namespace App\Enums;

enum Role: int
{
    case ADMIN = 1;      // Администратор
    case MODERATOR = 2;  // Модератор
    case USER = 3;       // Обычный пользователь
}
