<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pages = Page::paginate(10);

        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'body'
        ]);

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page;

        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->body = $data['body'];
        $page->save();

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);

        if ($page) {
            return view('admin.pages.edit', ['page' => $page]);
        }

        return redirect()->route('pages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if ($page) {

            $datas = $request->only([
                'title',
                'body'
            ]);

            if ($page['title'] !== $datas['title']) {

                $datas['slug'] = Str::slug($datas['title'], '-');

                $validator = Validator::make($datas, [
                    'title' =>  'required|string|max:100',
                    'body' => 'string',
                    'slug' => 'required|string|max:100|unique:pages'
                ]);
            } else {
                $validator = Validator::make($datas, [
                    'title' =>  'required|string|max:100',
                    'body' => 'string'
                ]);
            }

            if ($validator->fails()) {
                return redirect()->route('pages.edit', ['page' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $page->title = $datas['title'];
            $page->body = $datas['body'];

            if (!empty($datas['slug'])) {
                $page->slug = $datas['slug'];
            }

            $page->save();
        }
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('pages.index');
    }

    public function validator(array $datas)
    {
        return Validator::make($datas, [
            'title' =>  'required|string|max:100',
            'body' => 'string',
            'slug' => 'required|string|max:100|unique:pages'
        ]);
    }
}
