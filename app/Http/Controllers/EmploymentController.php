<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\EmploymentType;
use Illuminate\Http\Request;
use App\DataTables\EmploymentTypesDataTable as EmploymentTypes;

class EmploymentController extends Controller
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
     * Route name to employment types list
     *
     * @var string
     */
    protected $indexRoute = 'employment-types.index';

    /**
     * Route name to edit employment type
     *
     * @var string
     */
    protected $editRoute = 'employment-types.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'employment-type';

    /**
     * Display a listing of the resource.
     *
     * @param EmploymentTypes $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(EmploymentTypes $dataTable)
    {
        return $dataTable->render('app.employment_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.employment_types.create');
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
            'description' => 'max:255',
        ]);

        if (EmploymentType::whereName($request->name)->exists()) {

            Alert::error('Error', 'A similar record already exists');

            return redirect(route('employment_types.create'));
        }

        $employmentType = EmploymentType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $employmentType);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EmploymentType $employmentType)
    {
        return $this->edit($employmentType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(EmploymentType $employmentType)
    {
        return view('app.employment_types.edit', ['employmentType' => $employmentType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmploymentType $employmentType)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        $employmentType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $employmentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EmploymentType $employmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmploymentType $employmentType)
    {
        $employmentType->delete();

        Alert::success('Success', 'Record deleted successfully');

        return redirect(route($this->indexRoute));
    }
}
