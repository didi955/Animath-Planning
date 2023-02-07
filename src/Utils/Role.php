<?php

enum Role: int
{
    case SUPERVISOR = 1;
    case PROFESSOR = 2;

    public static function valueOf(int $id): Role
    {
        return match ($id) {
            1 => Role::SUPERVISOR,
            2 => Role::PROFESSOR,
            default => throw new \InvalidArgumentException('Invalid role id'),
        };
    }
}


