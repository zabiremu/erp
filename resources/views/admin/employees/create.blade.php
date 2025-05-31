@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Human Resource /</span> Add Employee
        <a href="{{ route('employees.index') }}" class="btn btn-primary float-end">Back</a>
    </h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Name"
                            class="form-control @error('name') is-invalid @enderror " >
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror " >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror " >
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="emp_code">Employee Code</label>
                        <input type="text" name="emp_code" placeholder="Employee Code"
                            class="form-control @error('emp_code') is-invalid @enderror " >
                        @error('emp_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="department">Department</label>
                        <input type="text" name="department" placeholder="Department"
                            class="form-control @error('department') is-invalid @enderror " >
                        @error('department')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" placeholder="Designation"
                            class="form-control @error('designation') is-invalid @enderror " >
                        @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="join_date">Join Date</label>
                        <input type="date" name="join_date"
                            class="form-control @error('join_date') is-invalid @enderror " >
                        @error('join_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="salary">Salary</label>
                        <input type="number" name="salary" placeholder="Salary"
                            class="form-control @error('salary') is-invalid @enderror " >
                        @error('salary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="status">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror ">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Employee</button>
            </form>
        </div>
    </div>
@endsection
