<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance_reports = EmployeeAttendance::leftJoin('attendance_statuses', 'employee_attendances.attendance_status_id', 'attendance_statuses.id')
            ->leftJoin('employees', 'employee_attendances.employee_id', 'employees.id')
            ->selectRaw("employees.id as employee_id")
            ->selectRaw("employees.employee_name as employee_name")
            ->selectRaw("count(case when attendance_statuses.tag = 'present' then employee_attendances.attendance_status_id end) as total_present")
            ->selectRaw("count(case when attendance_statuses.tag = 'absent' then employee_attendances.attendance_status_id end) as total_absent")
            ->selectRaw("count(case when attendance_statuses.tag = 'leave' then employee_attendances.attendance_status_id end) as total_leave")
            ->where('employee_attendances.outlet_id', session('outlet_id'))
            ->orderBy('employee_attendances.id', 'desc')
            ->groupBy('employee_attendances.employee_id')
            ->get();



        return view('pages.hr.employee_attendance.attendance_report', compact('attendance_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee_attendances = EmployeeAttendance::where('date', Carbon::today())->get();
        $attendance_statuses = DB::table('attendance_statuses')->select('id', 'tag', 'title')->get();
        $admin_employee = Employee::where('outlet_id', session('outlet_id'))->pluck('id')->first();
        $employees = Employee::where('outlet_id', session('outlet_id'))
            ->where('id', '!=', $admin_employee)
            ->select('id', 'employee_name')
            ->get();

        // return $employee_attendances->where('employee_id', '147');


        return view('pages.hr.employee_attendance.mark_attendance', compact('employees', 'employee_attendances', 'attendance_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'employee_id' => 'required',
            'attendance' => 'required',
        ]);



        $query = '';
        for ($count = 0; $count < count($request->employee_id); $count++) {
            $attendance_status_id = DB::table('attendance_statuses')->where('tag', $request->attendance[$count])->pluck('id')->first();
            if ($attendance_status_id) {
                $query = EmployeeAttendance::updateOrCreate(
                    [
                        'employee_id' => $request->employee_id[$count],
                        'date' => Carbon::today()
                    ],
                    [
                        'employee_id' => $request->employee_id[$count],
                        'attendance_status_id' => $attendance_status_id,
                        'remarks' => $request->remarks[$count],
                        'date' => Carbon::today(),
                        'created_by' => session('employee_id'),
                        'outlet_id' => session('outlet_id')
                    ]
                );
            }
        }
        //setting up success message
        if ($query) {
            $notification = array(
                'message' => 'Employee Attendance added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
        $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));

        if (request()->from_date == '' && request()->to_date == '') {
            // return 'test';
            return redirect()->route('employee-attendance.index');
        }

        $attendance_reports = EmployeeAttendance::leftJoin('attendance_statuses', 'employee_attendances.attendance_status_id', 'attendance_statuses.id')
            ->leftJoin('employees', 'employee_attendances.employee_id', 'employees.id')
            ->selectRaw("employees.employee_name as employee_name")
            ->selectRaw("employees.id as employee_id")
            ->selectRaw("count(case when attendance_statuses.tag = 'present' && employee_attendances.date >= date('" . $fromDate . "') && employee_attendances.date <= date('" . $toDate . "') then employee_attendances.attendance_status_id end) as total_present")
            ->selectRaw("count(case when attendance_statuses.tag = 'absent' && employee_attendances.date >= date('" . $fromDate . "') && employee_attendances.date <= date('" . $toDate . "') then employee_attendances.attendance_status_id end) as total_absent")
            ->selectRaw("count(case when attendance_statuses.tag = 'leave' && employee_attendances.date >= date('" . $fromDate . "') && employee_attendances.date <= date('" . $toDate . "') then employee_attendances.attendance_status_id end) as total_leave")
            ->where('employee_attendances.outlet_id', session('outlet_id'))
            ->orderBy('employee_attendances.id', 'desc')
            ->groupBy('employee_attendances.employee_id')
            ->get();

        return view('pages.hr.employee_attendance.attendance_report', compact('attendance_reports'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return 'hello';
        $employee = Employee::where('id', $id)->where('outlet_id', session('outlet_id'))->select('employee_name')->firstOrFail();
        if ($request->start) {
            $data = DB::table('employee_attendances')
                ->leftJoin('attendance_statuses', 'employee_attendances.attendance_status_id', 'attendance_statuses.id')
                ->where('employee_attendances.employee_id', $id)
                ->get(['employee_attendances.id', 'attendance_statuses.title as title', 'employee_attendances.date']);

            $data = $data->map(function ($item) {
                if ($item->title == 'Present') {
                    $item->className = 'fc-event-light fc-event-solid-success';
                }
                if ($item->title == 'Absent') {
                    $item->className = 'fc-event-light fc-event-solid-danger';
                }
                if ($item->title == 'Leave') {
                    $item->className = 'fc-event-light fc-event-solid-dark';
                }
                return $item;
            });
            return response()->json($data);
        }


        return view('pages.hr.employee_attendance.attendance_view', compact('id', 'employee'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $employee_attendance = EmployeeAttendance::find($id);
    //     $employees = Employee::where('outlet_id', session('outlet_id'))->get();
    //     $attendance_statuses = DB::table('attendance_statuses')->get();

    //     return view('pages.hr.employee_attendance.edit_employee_attendance', compact('employees', 'attendance_statuses', 'employee_attendance'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'employee_id' => 'required',
    //         'attendance_status_id' => 'required',
    //         'date' => 'required',
    //     ]);

    //     $employee_attendance = EmployeeAttendance::find($id)->update([
    //         'employee_id' => $request->employee_id,
    //         'attendance_status_id' => $request->attendance_status_id,
    //         'remarks' => $request->remarks,
    //         'date' => $request->date,
    //         'created_by' => session('employee_id'),
    //         'outlet_id' => $request->outlet_id,
    //     ]);


    //     //setting up success message
    //     if ($employee_attendance) {
    //         $notification = array(
    //             'message' => 'Employee Attendance updated successfully!',
    //             'alert-type' => 'success'
    //         );
    //     }
    //     //setting up error message
    //     else {
    //         $notification = array(
    //             'message' => 'Something went wrong!',
    //             'alert-type' => 'error'
    //         );
    //     }

    //     //redirecting to the page with notification message
    //     return redirect('outlets/hr/employee-attendance')->with($notification);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = EmployeeAttendance::find($id)->delete();

        if ($query) {
            $notification = array(
                'message' => 'Employee Attendance deleted successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/hr/employee-attendance')->with($notification);
    }
}
