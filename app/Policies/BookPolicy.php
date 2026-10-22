<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === 'admin' ? true : null;
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function update(User $user, Book $book): bool
    {
        return $user->role === 'editor' && $book->user_id === $user->id;
    }

    public function delete(User $user, Book $book): bool
    {
        return $this->update($user, $book);
    }
}