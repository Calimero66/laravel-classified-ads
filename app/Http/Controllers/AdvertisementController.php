<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Advertisement;
use App\Models\Category;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'adsByCategory']]);
    }

    /**
     * Display a listing of advertisements.
     */
    public function index(Request $request)
    {
        $ads = Advertisement::with('category')
            ->when($request->search, function ($query, $searchTerm) {
                $query->whereHas('category', function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%");
                });
            })
            ->paginate(12);

        $categories = Category::all();

        return view('advertisement.index', compact('ads', 'categories'));
    }

    /**
     * Display advertisements by category.
     */
    public function adsByCategory(Category $category)
    {
        $ads = $category->advertisements()->paginate(8);
        $categories = Category::all();

        return view('advertisement.index', compact('ads', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new advertisement.
     */
    public function create()
    {
        $categories = Category::all();

        return view('advertisement.create', compact('categories'));
    }

    /**
     * Store a newly created advertisement in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|min:10|max:1000',
            'price' => 'required|numeric|between:0,99999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ad = new Advertisement($validated);
        $ad->user_id = Auth::id();
        $ad->save();

        if ($request->hasFile('image')) {
            $this->updateImage($ad, $request->file('image'));
        }

        return redirect()->route('advertisement.show', $ad)
            ->with('message_type', 'success')
            ->with('message', 'You have successfully posted the advertisement.');
    }

    /**
     * Display the specified advertisement.
     */
    public function show(Advertisement $advertisement)
    {
        $ad = $advertisement;  // Rename to match view expectation
        return view('advertisement.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified advertisement.
     */
    public function edit(Advertisement $advertisement)
    {
        $ad = $advertisement;  // Rename to match view expectation
        $categories = Category::all();

        return view('advertisement.edit', compact('ad', 'categories'));
    }

    /**
     * Update the specified advertisement in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $validated = $request->validate([
            'description' => 'required|min:10|max:1000',
            'price' => 'required|numeric|between:0,99999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $advertisement->update($validated);

        if ($request->hasFile('image')) {
            $this->updateImage($advertisement, $request->file('image'));
        }

        return redirect()->route('advertisement.show', $advertisement)
            ->with('message_type', 'success')
            ->with('message', 'You have successfully updated the advertisement.');
    }

    /**
     * Remove the specified advertisement from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        if (!empty($advertisement->image_url) && File::exists(public_path($advertisement->image_url))) {
            File::delete(public_path($advertisement->image_url));
        }

        $advertisement->delete();

        return redirect()->route('advertisement.admin')
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted the advertisement.');
    }

    /**
     * Display the user's advertisements (admin view).
     */
    public function admin()
    {
        $ads = Advertisement::where('user_id', Auth::id())->get();

        return view('advertisement.admin', compact('ads'));
    }

    /**
     * Update the image for the specified advertisement.
     */
    private function updateImage(Advertisement $ad, $image)
    {
        if (!empty($ad->image_url) && File::exists(public_path($ad->image_url))) {
            File::delete(public_path($ad->image_url));
        }

        $imageName = $ad->id . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $ad->image_url = '/images/' . $imageName;
        $ad->save();
    }
}