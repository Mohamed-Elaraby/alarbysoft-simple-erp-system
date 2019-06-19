@extends('layouts.admin')

@section('title','Admin Create Serial')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Serial</h3>
            <form action="{{ route('admin.serials.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="product">Products</label>
                    <select name="product_id" id="product" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <table class="table" id="invoiceTable">
                    <thead>
                        <tr>
                            <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                            <th width="98%">Serial Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="case" type="checkbox"/></td>
                            <td><input type="text" name="data[0][serial]" id="serial_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                        </tr>
                    </tbody>
                </table>

                <div class='form-group'>
                    <button id="delete" class="btn btn-danger delete" type="button">- Delete</button>
                    <button id="addmore" class="btn btn-primary addmore" type="button">+ Add More</button>
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success btn-block">
                </div>

            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('admin/js/addSerials.js') }}"></script>
@endpush
@endsection
