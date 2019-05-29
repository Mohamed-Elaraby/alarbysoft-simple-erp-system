
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="author" content="muni">
    <meta name="description" content="Save Multiple Rows of Invoice Data In MySQL Database Using PHP, jQuery and Bootstrap 3, how to store/insert/save html table values into mysql database php jQuery">
    <meta name="keywords" content="Save Multiple Rows of Invoice Data In MySQL Database Using PHP, jQuery and Bootstrap 3, how to store/insert/save html table values into mysql database php jQuery, jquery autocomplete invoice, jquery autocomplete invoice module">
    <title>Insert Dynamically Added Input Fields Invoice Table Data in MySQL Database Using PHP jQuery Bootstrap 3</title>
    <link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#/">SmartTutorials.net</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="active"><a href="invoice-list.php">Invoice List</a></li>
                <li role="presentation"><a href="index.php">Create Invoice</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="clearfix"></div>        <!-- Insert your HTML here -->
<div class="container content">





    <form class="form-horizontal invoice-form" action="/insert-dynamically-added-input-fields-invoice-table-data-mysql-database-php-jquery-bootstrap3/index.php" id="invoice-form" method="post" role="form" novalidate>
        <div class='row no-margin'>
            <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                <div class="logo">
                    <img src="img/logo.png" alt="Company Logo">
                </div>
                <h4>Smart Invoice</h4>
                <p>
                    No: 13, Kamban Street, Krishnagiri
                    Tamil Nadu, India - 123456.
                </p>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-success submit_btn invoice-save-top form-control"> <i class="fa fa-floppy-o"></i>  Save Invoice </button>
                <div>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- IRCTC HOME -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:336px;height:280px"
                         data-ad-client="ca-pub-4997600402648823"
                         data-ad-slot="6651812194"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
        <hr>
        <div class="row no-margin">
            <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                <h4>Invoice To</h4>
                <div class="form-group">
                    <input type="email" class="form-control" name="clientCompanyName" id="clientCompanyName" placeholder="Company Name" value="Lime Software Solutions">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows='3' name="clientAddress" id="clientAddress" placeholder="Your Address">No:36, Valluvar Street, Chennai-60028</textarea>
                </div>
                <input type="hidden" value="1" name="client_id">
                <input type="hidden" value="" name="id">
                <input type="hidden" value="1" name="uuid">
            </div>
            <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                <h4>&nbsp;</h4>
                <div class="form-group">
                    <input type="number" class="form-control" name="invoiceNo" id="invoiceNo" placeholder="Invoice No">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control amountDue" id="amountDueTop" placeholder="Amount Due">
                </div>
            </div>
        </div>

        <hr>
        <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <div class="well">
                    <p class="text-center">Type either S1 OR S2 in item no column</p>
                </div>
                <table class="table table-bordered table-hover" id="invoiceTable">
                    <thead>
                    <tr>
                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                        <th width="15%">Item No</th>
                        <th width="38%">Item Name</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="15%">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="case" type="checkbox"/></td>
                        <td><input type="text" data-type="productCode" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                        <td><input type="text" data-type="productName" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                        <td><input type="number" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                        <td><input type="number" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                        <td><input type="number" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
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
                        <input type="number" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tax: &nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tax Amount: &nbsp;</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="tax" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Total: &nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Amount Paid: &nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Amount Due: &nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
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
</div> <!-- /container -->

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h2 class="text-center">
                <a href="http://www.smarttutorials.net/save-multiple-rows-of-invoice-data-in-mysql-database-using-php-jquery-and-bootstrap-3">Back To Tutorial</a>
            </h2>
        </div>
    </div>
</div>
<h2>&nbsp;</h2>
<footer class="footer">
    <div class="container">
        <p class="text-muted text-center" style="color:#fff"> &copy; Copyright By <a href="http://smarttutorials.net/" target="_blank" style="color:#bdc3c7">SmartTutorials.net</a>.</p>
    </div>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/ajax.js"></script>

</body>
</html>
