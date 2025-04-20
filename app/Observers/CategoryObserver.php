<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        // Génère le slug à partir du nom si non fourni
        if (empty($category->slug)) {
            $category->slug = $this->generateUniqueSlug($category->name);
        }
    }

    /**
     * Handle the Category "updating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        // Regénère le slug si le nom a changé
        if ($category->isDirty('name')) {
            $category->slug = $this->generateUniqueSlug($category->name, $category->id);
        }
    }

    /**
     * Génère un slug unique
     *
     * @param  string  $name
     * @param  int|null  $id
     * @return string
     */
    protected function generateUniqueSlug(string $name, ?int $id = null): string
    {
        $slug = Str::slug($name);
        $counter = 1;
        $originalSlug = $slug;

        while ($this->slugExists($slug, $id)) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Vérifie si un slug existe déjà
     *
     * @param  string  $slug
     * @param  int|null  $id
     * @return bool
     */
    protected function slugExists(string $slug, ?int $id = null): bool
    {
        return Category::where('slug', $slug)
            ->when($id, function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->exists();
    }
}