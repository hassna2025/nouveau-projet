<?php
// app/Http/Controllers/Admin/ContentController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with('category')->orderBy('level')->orderBy('order')->get();
        return view('admin.contents.index', compact('contents'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.contents.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        Content::create($validated);
        
        return redirect()->route('admin.contents.index')
            ->with('success', 'Content created successfully.');
    }
    
    // Ajouter les méthodes edit, update, destroy
}