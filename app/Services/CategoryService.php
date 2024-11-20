<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
        //
    }

    public function getCategoryDetailData(Category $category): Category
    {
        return $this->categoryRepository->getTicketBasedOnCategory($category);
    }
}
