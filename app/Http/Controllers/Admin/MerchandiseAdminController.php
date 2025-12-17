<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\MerchandiseLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MerchandiseAdminController extends Controller
{
    public function index()
    {
        $merchandise = Merchandise::latest()->paginate(10);
        return view('admin.merchandise.index', compact('merchandise'));
    }

    public function create()
    {
        return view('admin.merchandise.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'shop_name.*' => 'nullable|string|max:100',
            'url.*'       => 'nullable|url',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/merch'), $imageName);
        }

        $merchandise = Merchandise::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName,
            'created_by'   => Auth::guard('admin')->id(),
        ]);

        if ($request->shop_name && $request->url) {
            foreach ($request->shop_name as $index => $shop) {
                if (!empty($shop) && !empty($request->url[$index])) {
                    MerchandiseLink::create([
                        'merchandise_id' => $merchandise->id,
                        'shop_name'      => $shop,
                        'url'            => $request->url[$index],
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.merchandise.index')
            ->with('success', 'Merchandise berhasil ditambahkan.');
    }

// Edit dan Delete
    public function edit($id)
    {
        $merchandise = Merchandise::with('links')->findOrFail($id);
        return view('admin.merchandise.edit', compact('merchandise'));
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
