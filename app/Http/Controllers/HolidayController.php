<?php

namespace App\Http\Controllers;

use Alert;
use App\DataTables\HolidaysDataTable as Holidays;
use App\Models\Holiday;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HolidayController extends Controller
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
     * Route name to holiday types list
     *
     * @var string
     */
    protected $indexRoute = 'holidays.index';

    /**
     * Route name to edit holiday type
     *
     * @var string
     */
    protected $editRoute = 'holidays.edit';

    /**
     * The resource name used in routes.
     *
     * @var string
     */
    protected $resourceName = 'holiday';

    /**
     * Display a listing of the resource.
     *
     * @param Holidays $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(Holidays $dataTable)
    {
        return $dataTable->render('app.holidays.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.holidays.create');
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
            'date' => 'required|date',
        ]);

        if (Holiday::whereName($request->name)->exists()) {

            Alert::error('Error', 'A similar record already exists');

            return redirect(route('holidays.create'));
        }

        $holiday = Holiday::create([
            'name' => $request->name,
            'date' => $request->date,
            'is_annual' => $request->boolean('is_annual'),
        ]);

        Alert::success('Success', 'Record created successfully');

        return $this->redirectResponse($request, $holiday);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return $this->edit($holiday);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view('app.holidays.edit', ['holiday' => $holiday]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'date' => 'required|date',
        ]);

        $holiday->update([
            'name' => $request->name,
            'date' => $request->date,
            'is_annual' => $request->boolean('is_annual'),
        ]);

        Alert::success('Success', 'Record updated successfully');

        return $this->redirectResponse($request, $holiday);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        Alert::success('Success', 'Record deleted successfully');

        return redirect(route($this->indexRoute));
    }
}
