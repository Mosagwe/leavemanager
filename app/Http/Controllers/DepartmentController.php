<?php

namespace App\Http\Controllers;

use Alert;
use App\DataTables\DepartmentsDataTable as Departments;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
     * Route name to department types list
     *
     * @var string
     */
    protected $indexRoute = 'departments.index';

    /**
     * Route name to edit department type
     *
     * @var string
     */
    protected $editRoute = 'departments.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'department';

    /**
     * Display a listing of the resource.
     *
     * @param Departments $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(Departments $dataTable)
    {
        return $dataTable->render('app.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.departments.create');
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
            'name' => 'required|max:255',
        ]);

        if (Department::whereName($request->name)->exists()) {

            Alert::error('Error', 'A similar record already exists');

            return redirect(route('departments.create'));
        }

        $department = Department::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $department);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return $this->edit($department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('app.departments.edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $department->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        Alert::success('Success', 'Record deleted successfully');

        return redirect(route($this->indexRoute));
    }
}
