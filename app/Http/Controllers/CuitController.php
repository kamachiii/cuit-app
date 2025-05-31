<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CuitController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')->get();
        return view('home', compact('posts'));
    }

    public function post(Request $request): RedirectResponse
    {
        $request = Post::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        if ($request) {
            return redirect()->route('home')->with('success', 'Cuit posted successfully');
        }
        return redirect()->route('home')->with('error', 'Something went wrong');
    }
}
