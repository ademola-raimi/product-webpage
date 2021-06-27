
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("body").on("click","#delete-product",function(e){

        if(!confirm("Do you really want to delete this product?")) {
            return false;
        }

        e.preventDefault();
        var productId = $(this).attr('data-id');
        console.log('productId: ', productId);
        csrfmiddlewaretoken: '{{ csrf_token }}';
        var data = $('form').serialize()

        $.ajax(
            {
                url: "/product/"+ productId + "/delete", //or you can use url: "company/"+id,
                type: 'DELETE',
                data: data,
                success: function (response){

                    $("#success").html(response.message)

                    Swal.fire(
                        'Delete!',
                        'Product deleted successfully!',
                        'success'
                    )
                    setTimeout(function(){ location.reload(); }, 3000);
                }
            });
        return false;
    });

    $("#submit").click(function(e){

        e.preventDefault();

        const name = $("#product_name").val();
        const price = $("#price").val();
        const quantity = $("#quantity").val();
        let data = {
            name: name,
            price: price,
            quantity: quantity
        };

        data = $('form').serialize();
        if (name && price && quantity){
            $.ajax({
                url: "/product/create",
                method:'POST',
                data: data,

                success:function(response){
                    $("#success").html(response.message)

                    Swal.fire(
                        'Success!',
                        'Product successfully successfully!',
                        'success'
                    )

                    setTimeout(function(){ location.reload(); }, 3000);
                },

            });

        } else {
            Swal.fire(
                'Error!',
                'Please fill in all fields!',
                'Validation error'
            )
        }
    });
});
