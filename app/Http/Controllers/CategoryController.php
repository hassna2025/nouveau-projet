<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Affiche toutes les catégories (avec pagination)
     */
    public function index()
    {
        $categories = Category::query()
            ->withCount('learningItems')
            ->orderBy('order')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Crée une nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon ?? '📁',
            'order' => $request->order ?? 0
        ]);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 201);
    }

    /**
     * Affiche une catégorie spécifique avec ses contenus
     */
    public function show($id)
    {
        $category = Category::with(['learningItems' => function($query) {
            $query->where('is_active', true)
                  ->orderBy('difficulty_level');
        }])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Met à jour une catégorie existante
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255|unique:categories,name,'.$category->id,
            'icon' => 'nullable|string|max:50',
            'order' => 'sometimes|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $updates = $request->only(['icon', 'order']);
        
        if ($request->has('name')) {
            $updates['name'] = $request->name;
            $updates['slug'] = Str::slug($request->name);
        }

        $category->update($updates);

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Supprime une catégorie (soft delete)
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->learningItems()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer une catégorie avec des contenus associés'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Catégorie supprimée avec succès'
        ]);
    }

    /**
     * Endpoint supplémentaire pour listes déroulantes
     */
    public function list()
    {
        $categories = Category::select('id', 'name', 'icon')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}