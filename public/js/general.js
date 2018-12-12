$(document).on("submit","#search_product", function(e) {
    e.preventDefault();
    var form_data = $("#search_product").serialize();
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var action_url = $("#search_product").attr('data-action');
    $.ajax({
        method: 'POST',
        data: form_data,
        url: action_url,
        headers: { 
            'X-CSRF-TOKEN': csrf_token
        },         
        success: function (response)
        {
            if (typeof response.result !== "undefined" && !response.result) {
                $('.error-section').html("<div class='alert alert-danger'>"+response.message+"</div>");
                setTimeout(function(){ $('.alert').fadeOut('fast'); }, 2000);
            } else {
                $("#records").html(response);
            }
        }
    });
});


$(document).on('click', '#resetButton', function() {
    resetData();
});

function resetData() {
    $.get("products/reset", function(data){
        $("#records").html(data);
    }); 
}

$(document).ready( function() {
    $(document).on('click', '#data-table-basic-product tbody .delete-product', function(e) {
        e.preventDefault();
        if ( ! confirm('Are you sure want to delete?')) {
            return false;
        }
        var $this = $(this);
        $.ajax(
        {
            url: $this.attr('data-href'),
            type: 'POST',
            dataType: "JSON",
            data: {
                "_method": 'DELETE',
                "_token": $(this).data("token"),
            },
            success: function (response)
            {
                if(response.result) {
                    $this.parents('tr').remove();
                    $('.error-section').html("<div class='alert alert-success'>"+response.message+"</div>");
                    resetData();
                } else {
                    $('.error-section').html("<div class='alert alert-danger'>"+response.message+"</div>");
                }
                setTimeout(function(){ $('.alert').fadeOut('fast'); }, 3000);
            }
        });
    });
});