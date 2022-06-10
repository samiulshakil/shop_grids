@extends('frontend.layouts.master')

@section('mainContent')
    {{-- Hero Area and Banner section --}}
    @include('frontend.include.heroarea')

    {{-- Featured Category section --}}
    @include('frontend.include.featured_category')

    {{-- Ttending Product section --}}
    @include('frontend.include.trending_product')

    {{-- Banner section --}}
    @include('frontend.include.banner')

    {{-- Special Offer section --}}
    @include('frontend.include.special_offer')

    {{-- Best Seller, New Arrival and Top Rated section --}}
    @include('frontend.include.product_list')

    {{-- Brands section --}}
    @include('frontend.include.brands')

    {{-- Blog section --}}
    @include('frontend.include.blog')

    {{-- Shipping section --}}
    @include('frontend.include.shipping')
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#cartBtn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                if (id) {
                    $.ajax({
                        url: "{{ route('product.info') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $('.product_thumbnail').attr({
                                src: data.product.product_thumbnail
                            });
                            $('#product_id').val(data.product.id);
                            $('.product_name').text(data.product.product_name)
                            $('.product_code').text(data.product.product_code)
                            $('.category').text(data.product.category.category_name)
                            $('.brand').text(data.product.brand.brand_name)
                            let stock = data.product.product_qty
                            if (stock !== 0) {
                                $('.stock').text("In Stock")
                                $('.stock').addClass('text-success');
                            } else {
                                $('.stock').text("Out of stock")
                                $('.stock').addClass('text-danger');
                            }

                            //size
                            let options;
                            $.each(data.size, function(key, value) {
                                options = options + '<option value="' + value +
                                    '">' + value + '</option>';
                            });
                            let sizehtml =
                                `<div><label for="name">Size:</label><select id="product_size" name="product_size" class="form-select mt-2 mb-2"
                                                aria-label=".form-select-sm example"> +
                                ${options} '</select></div>`;

                            $(".sizeof").html(sizehtml);

                            //color
                            let optionss;
                            $.each(data.color, function(key, value) {
                                optionss = optionss + '<option value="' + value +
                                    '">' + value + '</option>';
                            });
                            let colorhtml =
                                `<div><label for="name">Color:</label><select id="product_color" name="product_color" class="form-select mt-2 mb-2"
                                                aria-label=".form-select-sm example"> +
                                ${optionss} '</select></div>`;

                            $(".colorof").html(colorhtml);

                        },
                        error: function(xhr, ajaxOption, thrownError) {
                            console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                                .responseText);
                        }
                    });
                }
            });

            //add to cart
            $('body').on('click', '.addcart', function(e) {
                e.preventDefault();
                $("#staticBackdrop").modal('hide');
                let id = $('#product_id').val();
                let product_size = $('#product_size').val();
                let product_color = $('#product_color').val();
                let qty = $('#qty').val();
                if (id) {
                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        type: "POST",
                        data: {
                            id: id,
                            qty: qty,
                            product_size: product_size,
                            product_color: product_color,
                            _token: _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            flashMessage(data.status, data.message);
                            $('.cart-items').html(data.cart_popup);
                        },
                        error: function(xhr, ajaxOption, thrownError) {
                            console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                                .responseText);
                        }
                    });
                }
            });
        });

        //toaster notification 
        function flashMessage(status, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            switch (status) {
                case 'success':
                    toastr.success(message, 'SUCCESS');
                    break;
                case 'error':
                    toastr.error(message, 'ERROR');
                    break;
                case 'info':
                    toastr.info(message, 'INFORMARTION');
                    break;
                case 'warning':
                    toastr.warning(message, 'WARNING');
                    break;
            }
        }
    </script>
@endpush
