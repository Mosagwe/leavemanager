<?php

namespace App\Http\Controllers;

use Alert;
use App\Events\EmployeeCreated;
use App\Events\EmployeeUpdated;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\EmploymentType;
use App\Notifications\AccountCreatedNotification;
use Illuminate\Http\Request;
use App\DataTables\EmployeesDataTable as Employees;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Route name to resource types list
     *
     * @var string
     */
    protected $indexRoute = 'employees.index';

    /**
     * Route name to edit resource type
     *
     * @var string
     */
    protected $editRoute = 'employees.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'employee';

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
     * @return \Illuminate\Http\Response
     */
    public function index(Employees $dataTable)
    {
        return $dataTable->render('app.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.employees.create', [
            'roles' => Role::all(),
            'employmentTypes' => EmploymentType::all(),
            'departments' => Department::all()
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

        $password = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => bcrypt($password),
            'role_id' => $request->role,
            'employment_type_id' => $request->employment_type,
            'department_id' => $request->department,
            'phone_number'=>$request->phone_number,
        ]);

        event(new EmployeeCreated($user));

        Notification::send($user, new AccountCreatedNotification($password));

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $user);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->edit($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.employees.edit', [
            'employee' => User::findOrFail($id),
            'roles' => Role::all(),
            'employmentTypes' => EmploymentType::all(),
            'departments' => Department::all()
        ]);
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
        $user = User::findOrFail($id);

        $this->validate($request, $this->rules($user));

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role_id' => $request->role,
            'employment_type_id' => $request->employment_type,
            'department_id' => $request->department,
            'phone_number'=>$request->phone_number,
        ]);


        event(new EmployeeUpdated($user));

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        Alert::success('Success', 'Employee deleted successfully');

        return redirect(route('employees.index'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param null $user
     * @return array
     */
    public function rules($user = null)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'phone_number' => [
                'required',
                'max:255'
            ],
            'role' => 'required',
            'gender' => 'required',
            'employment_type' => 'required',
            'department' => 'required',
        ];

        if (is_null($user)) {
            array_push($rules['email'], 'unique:users');

            return $rules;
        }

        array_push($rules['email'], Rule::unique('users')->ignore($user->id));

        return $rules;
    }
    public function changeStatus($id)
    {
        $employee=User::find($id);
        $employee->is_active = !$employee->is_active;
        if ($employee->save()){
            return redirect()->route('employees.index');
        }else{
            return back();
        }

    }
}
