<?php
// app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
        
        $validated['slug'] = \Str::slug($validated['name']);
        
        Category::create($validated);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }
    
    // Ajouter les méthodes edit, update, destroy
        public function test()
    {
        return response()->json([
            'status' => 'success',
            'string_test' => \Illuminate\Support\Str::slug('Test String'),
            'controller_base' => get_parent_class($this)
        ]);
    }
}