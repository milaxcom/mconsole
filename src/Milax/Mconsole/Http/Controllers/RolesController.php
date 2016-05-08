<?php

namespace Milax\Mconsole\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Http\Requests\MconsoleRoleRequest;
use Milax\Mconsole\Models\MconsoleRole;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\Repository;

class RolesController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;

    protected $model = 'Milax\Mconsole\Models\MconsoleRole';
    protected $redirectTo = '/mconsole/roles';
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, Repository $repository)
    {
        $this->setCaption(trans('mconsole::roles.menu.name'));
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        
        $this->form->addStyles([
            '/massets/global/plugins/jquery-multi-select/css/multi-select.css',
        ]);
        $this->form->addScripts([
            '/massets/global/plugins/jquery-multi-select/js/jquery.multi-select.js',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery($this->repository->index())->setAddAction('roles/create')->render(function ($item) {
            return [
                '#' => $item->id,
                trans('mconsole::roles.table.name') => $item->name,
                trans('mconsole::roles.table.users') => $item->users->count(),
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
        return $this->form->render('mconsole::roles.form', [
            'acl' => app('API')->acl->get(true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MconsoleRoleRequest $request)
    {
        $this->repository->create($request->all());
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
        return $this->form->render('mconsole::roles.form', [
            'item' => $this->repository->find($id),
            'acl' => app('API')->acl->get(true),
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
    public function update(MconsoleRoleRequest $request, $id)
    {
        $this->repository->update($id, $request->all());
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
        if ($this->repository->find($id)->users()->count() > 0) {
            return redirect()->back()->withErrors('Cannot role that in use.');
        } else {
            $this->repository->destroy($id);
        }
    }
}
