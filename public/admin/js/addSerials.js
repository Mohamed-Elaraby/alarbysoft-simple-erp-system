//adds extra table rows
var i=$('table#addSerials tr').length;
$("#addMoreRow").on('click',function(){
    html = '<tr>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="text" name="data['+i+'][serial]" id="serial_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '</tr>';
    $('table#addSerials').append(html);
    i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$("#remove").on('click', function() {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false);
    calculateTotal();
});
;
