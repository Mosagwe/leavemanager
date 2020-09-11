<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use App\Notifications\InplaceRequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Calculators\LeaveDatesCalculator;
use App\DataTables\LeaveApplicationsDataTable as LeaveRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use function GuzzleHttp\Promise\all;

class LeaveApplicationController extends Controller
{
    /**
     * Route name to resource types list
     *
     * @var string
     */
    protected $indexRoute = 'applications.index';

    /**
     * Route name to edit resource type
     *
     * @var string
     */
    protected $editRoute = 'applications.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'application';

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
     * Display a listing of the resource.
     *
     * @param LeaveRequests $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(LeaveRequests $dataTable)
    {
        return $dataTable->render('app.leave.applications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.leave.applications.create', [
            'employees' => User::inplaceUsers()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());

        $leaveDateCalculator = new LeaveDatesCalculator();
        $end_date = $leaveDateCalculator->endDate(
            LeaveType::find($request->leave_type),
            Carbon::createFromFormat('Y-m-d', $request->start_at),
            $request->days
        );

        $leaveRequest = LeaveRequest::create([
            'user_id' => Auth::user()->id,
            'start_at' => $request->start_at,
            'end_at' => $end_date,
            'leave_type_id' => $request->leave_type,
            'number_of_days' => $request->days,
            'reason' => $request->reason,
            'status' => LeaveRequest::PENDING_INPLACE,
            'employee_inplace' => $request->employee_inplace
        ]);

        Notification::send(User::find($request->employee_inplace), new InplaceRequestNotification($leaveRequest));

        Alert::success('Success', 'Leave request saved successfully')->persistent();

        return $this->redirectResponse($request, $leaveRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return new JsonResponse(LeaveRequest::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.leave.applications.edit', [
            'leaveRequest' => LeaveRequest::findOrFail($id),
            'employees' => User::inplaceUsers()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());

        $leaveDateCalculator = new LeaveDatesCalculator();
        $end_date = $leaveDateCalculator->endDate(
            LeaveType::find($request->leave_type),
            Carbon::createFromFormat('Y-m-d', $request->start_at),
            $request->days
        );

        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'start_at' => $request->start_at,
            'end_at' => $end_date,
            'leave_type_id' => $request->leave_type,
            'number_of_days' => $request->days,
            'reason' => $request->reason,
            'employee_inplace' => $request->employee_inplace
        ]);

        if ($leaveRequest->isDirty('employee_inplace')) {
            Notification::send(User::find($request->employee_inplace), new InplaceRequestNotification($leaveRequest));
        }

        Alert::success('Success', 'Record Updated successfully')->persistent();

        return $this->redirectResponse($request, $leaveRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LeaveRequest $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update([
            'status' => LeaveRequest::WITHDRAWN
        ]);

        Alert::success('Success', 'Application withdrawn successfully')->persistent();

        return redirect(route('applications.index'));
    }

    /**
     * The validation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'leave_type' => 'required',
            'start_at' => 'required',
            'days' => 'required',
            'employee_inplace' => 'required',
            'reason' => 'max:255'
        ];
    }


    public function getDates(Request $request)
    {
        $leaveCalculator = new LeaveDatesCalculator();

        $leaveType = LeaveType::find($request->leaveType);

        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate);

        return new JsonResponse([
            'endDate' => ($endDate = $leaveCalculator->endDate($leaveType, $startDate, $request->days))->format('Y-m-d'),
            'returnDate' => $leaveCalculator->returnDate($endDate)->format('Y-m-d'),
        ]);
    }
}
