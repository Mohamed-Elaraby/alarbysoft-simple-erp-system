@extends('layouts.admin')

@section('title','Admin Categories')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <div class="categories_table">
                    <form action="{{ route('admin.categories.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Sale Orders</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="categories_table" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Products Count</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col">Created_by</th>
                                            <th scope="col">created_at</th>
                                            <th scope="col">updated_at</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->products->count() }}</td>
                                            <td>{{ $category->type == 0 ? 'Main' : 'Sub'}}</td>
                                            <td>
                                                @if($category->type == 0)
                                                    No Parent
                                                @else
                                                    @foreach($subCategories as $sub)
                                                        {{ $sub->id == $category->type ? $sub->name : '' }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>{{ $category->updated_at }}</td>
                                            <td><a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                            <td>
                                                <input type="checkbox" name="id[]" value="{{ $category->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {
                $('#categories_table').DataTable({
                    dom: 'lBfrtip',
                    "buttons": [
                        { "extend": 'copy', "text":'Copy',"className": 'btn btn-default btn-xs' },
                        { "extend": 'csv', "text":'Csv',"className": 'btn btn-default btn-xs' },
                        { "extend": 'excel', "text":'Excel',"className": 'btn btn-default btn-xs' },
                        { "extend": 'pdf', "text":'Pdf',"className": 'btn btn-default btn-xs' },
                        { "extend": 'print', "text":'Print',"className": 'btn btn-default btn-xs' },
                    ],
                    responsive: true,
                    // scrollY:        "400vh",
                    // scrollX:        true,
                    // scrollCollapse: true,
                    paging:         true,
                    fixedColumns:   {
                        heightMatch: 'none'
                    },
                    "ordering": true,
                    "order": [[ 0, "desc" ]],
                })
            })
        </script>
    @endpush
@endsection
