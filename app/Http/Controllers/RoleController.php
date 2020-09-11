<?php

namespace App\Http\Controllers;

use Alert;
use App\DataTables\RolesDataTable as Roles;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Route name to role types list
     *
     * @var string
     */
    protected $indexRoute = 'roles.index';

    /**
     * Route name to edit role type
     *
     * @var string
     */
    protected $editRoute = 'roles.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'role';

    /**
     * Display a listing of the resource.
     *
     * @param Roles $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(Roles $dataTable)
    {
        return $dataTable->render('app.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.roles.create', [
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        if (Role::whereName($request->name)->exists()) {

            Alert::error('Error', 'A similar record already exists');

            return redirect(route('roles.create'));
        }

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->attach($request->permissions);

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $role);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->edit($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('app.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->detach();
        $role->permissions()->attach($request->permissions);

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();

        $role->delete();

        Alert::success('Success', 'Record deleted successfully');

        return redirect(route($this->indexRoute));
    }
}
