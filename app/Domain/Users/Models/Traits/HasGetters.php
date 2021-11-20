<?php

declare(strict_types=1);

namespace Domain\Users\Models\Traits;

trait HasGetters
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
