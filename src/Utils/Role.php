<?php

enum Role: int
{
    case SUPERVISOR = 1;
    case EXHIBITOR = 2;
    case PROFESSOR = 3;

    public static function valueOf(int $id): Role
    {
        return match ($id) {
            1 => Role::SUPERVISOR,
            2 => Role::EXHIBITOR,
            3 => Role::PROFESSOR,
            default => throw new \InvalidArgumentException('Invalid role id'),
        };
    }
}

