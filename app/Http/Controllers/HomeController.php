<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            // Vérification du rôle admin (2 méthodes possibles)
            
            // Méthode 1: Si vous avez une colonne 'is_admin' dans users
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.categories.index');
            }
            
            // Méthode 2: Si vous utilisez un système de rôles/policies
            // if (Auth::user()->hasRole('admin')) {
            //     return redirect()->route('admin.categories.index');
            // }
            
            return redirect()->route('client.categories');
        }

        // Récupération des catégories avec les scopes
        $categories = Category::featured()
            ->ordered()
            ->take(6)
            ->get();

        return view('welcome', compact('categories'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about');
    }
}