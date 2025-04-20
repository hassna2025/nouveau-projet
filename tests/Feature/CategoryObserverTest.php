<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryObserverTest extends TestCase
{
    public function test_slug_generation_on_create()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'icon' => '⭐'
        ]);

        $this->assertEquals('test-category', $category->slug);
    }

    public function test_slug_update_on_name_change()
    {
        $category = Category::create([
            'name' => 'Original Name',
            'icon' => '⭐'
        ]);

        $category->update(['name' => 'Updated Name']);

        $this->assertEquals('updated-name', $category->fresh()->slug);
    }

    public function test_unique_slug_generation()
    {
        Category::create(['name' => 'Duplicate', 'icon' => '⭐']);
        $category = Category::create(['name' => 'Duplicate', 'icon' => '⭐']);

        $this->assertEquals('duplicate-1', $category->slug);
    }
}