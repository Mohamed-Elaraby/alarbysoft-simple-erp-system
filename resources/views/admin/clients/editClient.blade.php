@extends('layouts.admin')

@section('title','Admin Edit Client')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Client</h3>
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="store">Client</label>
                        <input name="name" type="text" class="form-control" id="store" value="{{ $client->name }}">
                    </div>

                    <div class="form-group">
                        <label for="balance">Balance</label>
                        <input name="balance" type="text" class="form-control" id="balance" value="{{ $client->balance }}">
                    </div>

                    <div class="form-group">
                        <label for="phones">Phones</label>
                        <input name="phones" type="text" class="form-control" id="phones" value="{{ $client->phones }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
