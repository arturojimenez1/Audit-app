<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super_admin';
    case AUDITOR = 'auditor';
    case CLIENT = 'client';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Administrador',
            self::AUDITOR => 'Auditor',
            self::CLIENT => 'Usuario Cliente',
        };
    }
}
