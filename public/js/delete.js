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
                } else {
                    $('.error-section').html("<div class='alert alert-danger'>"+response.message+"</div>");
                }
                setTimeout(function(){ $('.alert').fadeOut('fast'); }, 3000);
            }
        });
    });
});