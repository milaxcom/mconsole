<?php

namespace Milax\Mconsole\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Http\Requests\NewsRequest;
use Milax\Mconsole\Models\News;
use Paginatable;
use Redirectable;
use HasQueryTraits;

class NewsController extends Controller
{
    use HasQueryTraits, Redirectable, Paginatable;

    protected $redirectTo = '/mconsole/news';
    protected $model = 'Milax\Mconsole\Models\News';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->setPerPage(20)->run('mconsole::news.list', function ($item) {
            return [
                '#' => $item->id,
                'Published' => $item->published_at->format('m.d.Y'),
                'Updated' => $item->updated_at->format('m.d.Y'),
                'Slug' => $item->slug,
                'Heading' => $item->heading,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mconsole::news.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        News::create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('mconsole::news.form', [
            'item' => News::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        News::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
    }
}
