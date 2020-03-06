<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index()
    {

        return view('admin.categories.index', ['title' => 'Categories List']);
    }

    public function getCategories(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'slug',
            3 => 'created_at',
            4 => 'action'
        );

        $totalData = Category::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $categories = Category::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Category::count();
        } else {
            $search = $request->input('search.value');
            $categories = Category::where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhere('created_at', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Category::where('name', 'like', "%{$search}%")
                ->count();
        }


        $data = array();

        if ($categories) {
            foreach ($categories as $r) {
                $edit_url = route('categories.edit', $r->id);
                $nestedData['id'] = '
                                <td>
                                <div class="checkbox checkbox-success m-0">
                                        <input id="checkbox_' . $r->id . '" type="checkbox" name="categories_id[]" value="' . $r->id . '">
                                        <label for="checkbox_' . $r->id . '"></label>
                                    </div>
                                </td>
                            ';
                $nestedData['name'] = $r->name;
                $nestedData['slug'] = $r->slug;
                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-info btn-circle" onclick="event.preventDefault();viewInfo(' . $r->id . ');" title="View Details" href="javascript:void(0)">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Edit Row" class="btn btn-primary btn-circle"
                                       href="' . $edit_url . '">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-circle" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete User" href="javascript:void(0)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                </div> 
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', ['title' => 'Add Category']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $input = $request->all();
        $feature = new Category();
        $feature->name = $input['name'];
        $feature->save();
        Session::flash('success_message', 'Great! Categories has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::findOrFail($id);
        return view('admin.categories.edit', ['title' => 'Update Category Details', 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $feature = Category::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $input = $request->all();
        $feature->name = $input['name'];
        $feature->save();
        Session::flash('success_message', 'Great! Category successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('success_message', 'Category successfully deleted!');
        return redirect()->route('categories.index');
    }

    public function deleteSelectedCategories(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'categories_id' => 'required',

        ]);
        foreach ($input['categories_id'] as $index => $id) {

            $slider = Category::findOrFail($id);
            $slider->delete();

        }
        Session::flash('success_message', 'Categories successfully deleted!');
        return redirect()->back();

    }

    public function categoryDetail(Request $request)
    {
        $categories = Category::findOrFail($request->input('id'));
        return view('admin.categories.single', ['title' => 'Categories Detail', 'categories' => $categories]);
    }


}
