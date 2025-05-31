@extends('layouts.app')

@section('content')
    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.css">
    @endsection
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Human Resource /</span> Employees
        <a href="{{ route('employees.create') }}" class="btn btn-primary float-end">Add Employee</a>
    </h4>
    <div class="card">
        <div class="card-body">
            <table id="employees-table" class="table">
                <thead>
                    <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Emp Code</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Join Date</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('employees.index') }}',
                columns: [{
                        data: 'id',
                        name: 'ID'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'emp_code',
                        name: 'emp_code'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
                    },
                    {
                        data: 'join_date',
                        name: 'join_date'
                    },
                    {
                        data: 'salary',
                        name: 'salary'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
