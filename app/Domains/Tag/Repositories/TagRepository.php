<?php

declare(strict_types=1);

namespace App\Domains\Tag\Repositories;

use App\Domains\Tag\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    /**
     * @param array $data
     * 
     * @return Tag
     */
    public function findOrCreate(array $data): Tag
    {
        return Tag::firstOrCreate([
            'name'        => $data['name'],
            'description' => $data['description'],
        ]);
    }
}