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
                    getProducts(1);
                } else {
                    $('.error-section').html("<div class='alert alert-danger'>"+response.message+"</div>");
                }
                setTimeout(function(){ $('.alert').fadeOut('fast'); }, 3000);
            }
        });
    });

    function getProducts(page=1) {
        var sort = $('meta[name="sort"]').attr('content');
        var records = $('meta[name="record_per_page"]').attr('content');
        var sort_column = $('meta[name="sort_column"]').attr('content');
        var action_url = $('meta[name="search_url"]').attr('content');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: action_url,
            type: "POST",
            data: {
                "_token": csrf_token,
                "page":page,
                "records":records,
                "order_by":sort_column,
                "search_on":sort
            },
            success: function(response) { 
                if (typeof response.result !== "undefined" && !response.result) {
                    $('.error-section').html("<div class='alert alert-danger'>"+response.message+"</div>");
                    setTimeout(function(){ $('.alert').fadeOut('fast'); }, 2000);
                } else {
                    $("#records").html(response);
                }
            }
        });
    }

    $(document).on('click', '#resetButton', function() {
        getProducts(1);
    });

    getProducts(1);

    $('body').on('click', '.pagination a', function(e) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        e.preventDefault();
        var myurl = $(this).attr('href');
        var page= $(this).attr('href').split('page=')[1];
        getProducts(page);
    });
});
