<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function index()
    {
        // Retrieve items from the database
        $items = Item::all();

        // Pass items to the view
        return view('items.index', compact('items'));
    }

    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::all(); // You can use pagination if needed

            return DataTables::of($items)
                ->addIndexColumn()  // Adds the 'No' column (index) automatically
                ->addColumn('publish', function ($row) {
                    return $row->publish ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('items.show', $row->id) . '" class="btn btn-info btn-sm">View</a>
                            <a href="' . route('items.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('items.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->rawColumns(['action']) // Ensure raw HTML in action column
                ->make(true);
        }
    }


    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'details' => 'required',
            'publish' => 'required|boolean',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'details' => 'required',
            'publish' => 'required|boolean',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
