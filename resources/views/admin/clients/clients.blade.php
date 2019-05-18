@extends('layouts.admin')

@section('title','Admin Clients')

@section('content')
    <div class="">
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
                <div class="products_table">
                    <form action="{{ route('admin.destroyClient') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-dark" id="Clients_table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Client</th>
                                <th scope="col">Balance</th>
                                <th scope="col">phones</th>
                                <th scope="col">Created_by</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <th scope="col">{{ $client->id }}</th>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->balance }}</td>
                                    <td>{{ $client->phones }}</td>
                                    <td>{{ $client->user->name }}</td>
                                    <td>{{ $client->created_at }}</td>
                                    <td>{{ $client->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editClient', $client->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-warning">Details</a></td>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $client->id }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                    <div id="show">

                    </div>
                    <div class="paginate col-md-offset-5">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
