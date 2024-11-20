<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::all();
    }

    public function getTicketBasedOnCategory(Category $category): Category
    {
        $category->load(['tickets', 'tickets.city:id,name'])->loadCount('tickets');
        return $category;
    }
}
