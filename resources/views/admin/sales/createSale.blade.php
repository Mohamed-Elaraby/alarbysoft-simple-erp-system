@extends('layouts.admin')

@section('title','Admin Create Sales Order')

@section('content')
<div class="">
    <div class="row">
        <div class=" col-sm-12">
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
            <h3 class="text-center"><i class="fa fa-edit"></i> Sale Order</h3>
            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <!-- Logo Area -->
                <div class='row no-margin'>
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <div class="logo">
                            <img src="img/logo.png" alt="Company Logo">
                        </div>
                        <h4><b>A</b>larby<b>S</b>oft</h4>
                        <p>
                            No: 13, Kamban Street, Krishnagiri
                            Tamil Nadu, India - 123456.
                        </p>
                    </div>
                </div>
                <!-- End Logo Area -->
                <hr>
                <div class="row no-margin">
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <div class="form-group">
                            <label for="client">Client</label>
                            <select name="client_id" id="client" class="form-control">
                                <option value=""></option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="invoiceNo">Invoice Number</label>
                            <input type="text" class="form-control" name="invoiceNo" id="invoiceNo">
                        </div>
                        <div class="form-group">
                            <label for="invoiceDate">Invoice Date</label>
                            <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" data-date-format='yyyy-mm-dd'>
                        </div>
                    </div>

                </div>

                <hr>
                <div class='row'>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <div class="well">
                            <h1 class="text-center">Items List</h1>
                        </div>
                        <table class="table table-bordered table-hover" id="invoiceTable">
                            <thead>
                            <tr>
                                <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
{{--                                <th width="15%">Item No</th>--}}
                                <th width="38%">Item Name</th>
                                <th width="15%">Price</th>
                                <th width="15%">Quantity</th>
                                <th width="15%">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input class="case" type="checkbox"/></td>
{{--                                <td><input type="text" data-type="productCode" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>--}}
                                <td><input type="text" data-type="productName" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                                <td><input type="text" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                                <td><input type="text" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                                <td><input type="text" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
                        <button id="delete" class="btn btn-danger delete" type="button">- Delete</button>
                        <button id="addmore" class="btn btn-success addmore" type="button">+ Add More</button>
                        <h2>Notes: </h2>
                        <div class="form-group">
                            <textarea class="form-control" rows='5' name="notes" id="notes" placeholder="Your Notes"></textarea>
                        </div>
                    </div>

                    <div class='col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3'>

                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">%</div>
                                <input type="text" class="form-control" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax Amount: &nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tax" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                <div class="input-group-addon">$</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Payment Method: &nbsp;</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" id="cash" name="payment_method" checked>
                                <label class="form-check-label" for="cash">
                                    Cash
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" id="due" name="payment_method">
                                <label class="form-check-label" for="due">
                                    Due
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Amount Paid: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Amount Due: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>

                    </div>
                </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-xs-12 col-sm-12">
                        <div class="text-center">
                            <button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-success submit_btn invoice-save-bottom form-control"> <i class="fa fa-floppy-o"></i>  Save Invoice </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('admin/js/ajax.js') }}"></script>
    <script>
        $("#invoiceDate").datepicker().datepicker("setDate", new Date());
        $('#amountPaid').val('0.00');
    </script>
@endpush
@endsection
