<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $employees = Employee::with('user')->select('employees.*');
            return DataTables::eloquent(
                Employee::with('user')->select('employees.*')
            )
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="' . route('employees.edit', $row->id) . '" class="btn btn-xs btn-primary">Edit</a>
                         <form action="' . route('employees.destroy', $row->id) . '" method="POST" style="display:inline;">
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                             <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this employee?\')">Delete</button>
                         </form>';
            })
            ->addColumn('status', function ($row) {
                $status = $row->status == 'active' ? 'Active' : 'Inactive';
                return '<a href="' . route('employees.status', $row->id) . '" class="btn btn-sm btn-primary" onclick="return confirm(\'Are you sure you want to change the status of this employee?\')">' . $status . '</a>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
            
        }

        return view('admin.employees.index');
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'emp_code' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'join_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Employee::create([
            'user_id' => $user->id,
            'emp_code' => $request->emp_code,
            'department' => $request->department,
            'designation' => $request->designation,
            'join_date' => $request->join_date,
            'salary' => $request->salary,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }


    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->user->id,
            'emp_code' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'join_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $employee->update([
            'emp_code' => $request->emp_code,
            'department' => $request->department,
            'designation' => $request->designation,
            'join_date' => $request->join_date,
            'salary' => $request->salary,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->user()->delete();
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }

    public function status(Employee $employee)
    {
        $employee->status = $employee->status == 'active' ? 'inactive' : 'active';
        $employee->save();
        return redirect()->route('employees.index')->with('success', 'Employee status updated successfully');
    }
}
