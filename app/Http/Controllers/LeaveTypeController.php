<?php

namespace App\Http\Controllers;

use Alert;
use App\DataTables\LeaveTypesDataTable as LeaveTypes;
use App\Events\LeaveTypeCreated;
use App\Events\LeaveTypeUpdated;
use App\Models\EmploymentType;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
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
    protected $indexRoute = 'leave-types.index';

    /**
     * Route name to edit employment type
     *
     * @var string
     */
    protected $editRoute = 'leave-types.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'leave_type';

    /**
     * Display a listing of the resource.
     *
     * @param LeaveTypes $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(LeaveTypes $dataTable)
    {
        return $dataTable->render('app.leave_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.leave_types.create', [
            'employmentTypes' => EmploymentType::all()
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
        $this->validate($request, $this->rules());

        if (LeaveType::whereName($request->name)->exists()) {

            Alert::error('Error', 'A similar record already exists');

            return redirect(route('leave-types.create'));
        }

        $leaveType = LeaveType::create([
            'name' => $request->name,
            'maximum_days' => $request->maximum_days,
            'carry_over_days' => $request->carry_over_days,
            'gender' => $request->gender,
            'can_use_partially' => $request->boolean('can_use_partially'),
            'calendar_days' => $request->boolean('calendar_days'),
        ]);

        $leaveType->employmentTypes()->attach($request->employment_types);

        event(new LeaveTypeCreated($leaveType));

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $leaveType);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LeaveType $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveType $leaveType)
    {
        return $this->edit($leaveType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LeaveType $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveType $leaveType)
    {
        return view('app.leave_types.edit', [
            'leaveType' => $leaveType,
            'employmentTypes' => EmploymentType::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LeaveType $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        $this->validate($request, $this->rules());

        $leaveType->update([
            'name' => $request->name,
            'maximum_days' => $request->maximum_days,
            'carry_over_days' => $request->carry_over_days,
            'gender' => $request->gender,
            'can_use_partially' => $request->boolean('can_use_partially'),
            'calendar_days' => $request->boolean('calendar_days'),
        ]);

        $leaveType->employmentTypes()->detach();
        $leaveType->employmentTypes()->attach($request->employment_types);

        event(new LeaveTypeUpdated($leaveType));

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $leaveType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LeaveType $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leaveType)
    {
        $leaveType->employmentTypes()->detach();

        $leaveType->delete();

        Alert::success('Success', 'Record deleted successfully');

        return redirect(route($this->indexRoute));
    }

    /**
     * Form validation rules.
     *
     * @return string[]
     */
    private function rules()
    {
        return [
            'name' => 'required|max:255',
            'maximum_days' => 'required|integer',
            'carry_over_days' => 'required|integer',
            'gender' => 'required|max:255'
        ];
    }
}
