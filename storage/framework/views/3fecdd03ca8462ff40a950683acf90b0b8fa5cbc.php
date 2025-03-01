<script type="text/javascript">
    $(function () {
        $("img").click(function () {
            $(this).toggleClass("hover");
            var id = [];
            $(".hover").each(function () {
                //jQuery.each('.hover', function() {
                id.push(jQuery(this).attr("image_id"));

            });
            //  id.push(jQuery('.test_image').attr("image_id"));
            jQuery('#images').val(id);
            console.log(id);
        });

        $("#btn").click(function () {

            if (confirm("<?php echo e(trans('labels.Are You Sure To Delete This?')); ?>")) {

                var imgs = $("img.hover").length;
                var parentFrom = $('#images_form');
                var formData = parentFrom.serialize();
                console.log(imgs);
                if (imgs > 0) {
                    $.ajax({
                        url: '<?php echo e(URL::to("admin/media/delete")); ?>',
                        type: "POST",
                        data: formData,
                        success: function (res) {
                            if (res == 'success') {
                                location.reload();
                            }
                        },
                    });
                } else {
                    alert('Please choose image first.');
                }

            } else {
                // Do nothing!

            }


        });

        jQuery("#btn11").click(function () {
            var images = '<?php echo $images; ?>';
            var all_images = JSON.parse(images);
            jQuery.each(all_images, function () {
                jQuery('.test_image').addClass("hover");
            });
            var id = [];
            $(".hover").each(function () {
                id.push(jQuery(this).attr("image_id"));

            });
            jQuery('#images').val(id);

        });
        jQuery("#btn12").click(function () {
            var images = '<?php echo $images; ?>';
            var all_images = JSON.parse(images);
            jQuery.each(all_images, function () {
                jQuery('.test_image').removeClass("hover");

            });

        });


    });


    $(document).ready(function () {
        $("#header_img").hover(function () {
            $(".hover_option").css("display", "none");
            $(".header_options").slideDown("fast");
        });
        $("#carousal_img").hover(function () {
            $(".hover_option").css("display", "none");
            $(".carousal_options").slideDown("fast");
        });
        $("#footer_img").hover(function () {
            $(".hover_option").css("display", "none");
            $(".footer_options").slideDown("fast");
        });
        $.each(new Array(12),
            function (n) {
                $("#banner_img_" + n).hover(function () {
                    $(".hover_option").css("display", "none");
                    $(".banner_options_" + n).slideDown("fast");
                });
            }
        );
    });

    jQuery(document).ready(function () {
        showCartImage();
        showDetailImage();
        showShopImage();
        showContactImage();
        showLoginImage();
        showNewsImage();

    });

    function showCartImage() {
        var cart_id = jQuery('#cart_id').val();
        jQuery('#cart_image1').hide();
        jQuery('#cart_image2').hide();

        if (cart_id == 1) {
            jQuery('#cart_image1').show();
        }

        if (cart_id == 2) {
            jQuery('#cart_image2').show();
        }

    }

    function showContactImage() {
        var contact_id = jQuery('#contact_id').val();
        jQuery('#contact_image1').hide();
        jQuery('#contact_image2').hide();

        if (contact_id == 1) {
            jQuery('#contact_image1').show();
        }

        if (contact_id == 2) {
            jQuery('#contact_image2').show();
        }

    }

    function showLoginImage() {
        var contact_id = jQuery('#login_id').val();
        jQuery('#login_image1').hide();
        jQuery('#login_image2').hide();

        if (contact_id == 1) {
            jQuery('#login_image1').show();
        }

        if (contact_id == 2) {
            jQuery('#login_image2').show();
        }

    }

    function showNewsImage() {
        var contact_id = jQuery('#news_id').val();
        jQuery('#news_image1').hide();
        jQuery('#news_image2').hide();

        if (contact_id == 1) {
            jQuery('#news_image1').show();
        }

        if (contact_id == 2) {
            jQuery('#news_image2').show();
        }

    }


    function showDetailImage() {
        var cart_id = jQuery('#detail_id').val();
        jQuery('#detail_image1').hide();
        jQuery('#detail_image2').hide();
        jQuery('#detail_image3').hide();
        jQuery('#detail_image4').hide();
        jQuery('#detail_image5').hide();
        jQuery('#detail_image6').hide();


        if (cart_id == 1) {
            jQuery('#detail_image1').show();

        }

        if (cart_id == 2) {
            jQuery('#detail_image2').show();
        }

        if (cart_id == 3) {
            jQuery('#detail_image3').show();
        }

        if (cart_id == 4) {
            jQuery('#detail_image4').show();
        }

        if (cart_id == 5) {
            jQuery('#detail_image5').show();
        }

        if (cart_id == 6) {
            jQuery('#detail_image6').show();
        }

    }

    function showShopImage() {
        var cart_id = jQuery('#shop_id').val();
        jQuery('#shop_image1').hide();
        jQuery('#shop_image2').hide();
        jQuery('#shop_image3').hide();
        jQuery('#shop_image4').hide();
        jQuery('#shop_image5').hide();


        if (cart_id == 1) {
            jQuery('#shop_image1').show();

        }

        if (cart_id == 2) {
            jQuery('#shop_image2').show();
        }

        if (cart_id == 3) {
            jQuery('#shop_image3').show();
        }

        if (cart_id == 4) {
            jQuery('#shop_image4').show();
        }

        if (cart_id == 5) {
            jQuery('#shop_image5').show();
        }

    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();

            //Date range picker
            $('.reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'MM/DD/YYYY h:mm A'
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });


        });


        function propchecked(parents_id) {
            //alert(parents_id);
            $('#categories_' + parents_id).prop('checked', true);
            var parent_id = $('#categories_' + parents_id).attr('parents_id');
            if (parents_id !== undefined) {
                //call nested function
                propchecked(parent_id);
            }
        }

        function propunchecked(parents_id) {
            $('.sub_categories_' + parents_id).prop('checked', false);
            $('.sub_categories_' + parents_id).each(function () {
                var subparents_id = $(this).attr('id');
                var subparents_id = subparents_id.replace("categories_", "");
                propunchecked(subparents_id);
            });
        }

// check sub categories
        $(document).on('click', '.sub_categories', function () {

            if ($(this).is(':checked')) {
                var parents_id = $(this).attr('parents_id');
                if (parents_id !== undefined) {
                    propchecked(parents_id);
                }
            } else {
                var parents_id = $(this).attr('id');
                if (parents_id !== undefined) {
                    var parents_id = parents_id.replace("categories_", "");
                    propunchecked(parents_id);
                }
            }

        });

        $('#dob').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            endDate: "today"
        });

// check parents categories
// $(document).on('click', '.categories', function(){
// 	if($(this).is(':checked')){
// 	}else{
// 		var parents_id = $(this).val();
// 		//$('.sub_categories_'+parents_id).prop('checked', false);
// 	}

// });


        $(document).on('click', '.checkboxess', function (e) {
            checked = $("input[type=checkbox]:checked.checkboxess").length;
            if (!checked) {
                //alert("You must check at least one checkbox.");
                return false;
            }

        });

        $(document).ready(function (e) {

            //brantree_active
            $(document).on('click', '#brantree_active', function () {
                //has-error
                if ($(this).is(':checked')) {
                    $('.brantree_active').addClass('field-validate');
                } else {
                    $('.brantree_active').parents('div.form-group').removeClass('has-error');
                    $('.brantree_active').removeClass('field-validate');

                }

            });

            $(document).on('click', '#cash_on_delivery', function () {

                if ($(this).is(':checked')) {
                    $('.cash_on_delivery').addClass('field-validate');
                } else {
                    $('.cash_on_delivery').parents('div.form-group').removeClass('has-error');
                    $('.cash_on_delivery').removeClass('field-validate');
                }

            });

            //paypal_status
            $(document).on('click', '#paypal_status', function () {

                if ($(this).is(':checked')) {
                    $('.paypal_status').addClass('field-validate');
                } else {
                    $('.paypal_status').parents('div.form-group').removeClass('has-error');
                    $('.paypal_status').removeClass('field-validate');
                }

            });

            //cybersource
            $(document).on('click', '#cybersource_status', function () {

                if ($(this).is(':checked')) {
                    $('.cybersource_status').addClass('field-validate');
                } else {
                    $('.cybersource_status').parents('div.form-group').removeClass('has-error');
                    $('.cybersource_status').removeClass('field-validate');
                }

            });


            //brantree_active
            $(document).on('click', '#stripe_active', function () {

                if ($(this).is(':checked')) {
                    $('.stripe_active').addClass('field-validate');
                } else {
                    $('.stripe_active').parents('div.form-group').removeClass('has-error');
                    $('.stripe_active').removeClass('field-validate');
                }

            });

            $(document).on('click', '#instamojo_active', function () {

                if ($(this).is(':checked')) {
                    $('.instamojo_active').addClass('field-validate');
                } else {
                    $('.instamojo_active').parents('div.form-group').removeClass('has-error');
                    $('.instamojo_active').removeClass('field-validate');
                }

            });

            $(document).on('click', '#hyperpay_active', function () {

                if ($(this).is(':checked')) {
                    $('.hyperpay_active').addClass('field-validate');
                } else {
                    $('.hyperpay_active').parents('div.form-group').removeClass('has-error');
                    $('.hyperpay_active').removeClass('field-validate');
                }

            });

            $(document).on('click', '#payumoney_active', function () {

                if ($(this).is(':checked')) {
                    $('.payumoney_active').addClass('field-validate');
                } else {
                    $('.payumoney_active').parents('div.form-group').removeClass('has-error');
                    $('.payumoney_active').removeClass('field-validate');
                }

            });


            $(document).on('click', '#razorpay_active', function () {

                if ($(this).is(':checked')) {
                    $('.razorpay_active').addClass('field-validate');
                } else {
                    $('.razorpay_active').parents('div.form-group').removeClass('has-error');
                    $('.razorpay_active').removeClass('field-validate');
                }

            });

        });

//ajax call for add option value
        $(document).on('click', '.currentstock', function (e) {
            $("#loader").show();
            var options_id = $(this).attr('attributeid');
            var attributeid = $(this).val();
            $('.attributeid_' + options_id).val(attributeid);
            var formData = $('#addewinventoryfrom').serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/currentstock")); ?>',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    $('#current_stocks').html(res.remainingStock);
                    //console.log(res.remainingStock);
                    var min_level = 0;
                    var max_level = 0;
                    var inventory_ref_id = res.inventory_ref_id;
                    var purchasePrice = res.purchasePrice;
                    var products_id = res.products_id;

                    if (res.minMax != '') {
                        min_level = res.minMax[0].min_level;
                        max_level = res.minMax[0].max_level;
                        var products_id = res.minMax[0].products_id;
                        $('.products_id').val(products_id);
                        $('#inventory_pro_id').val(products_id);

                    }

                    $('#min_level').val(min_level);
                    $('#products_id').val(products_id);
                    $('#max_level').val(max_level);
                    $('#inventory_ref_id').val(inventory_ref_id);
                    $('#inventory_pro_id').val(products_id);
                    $('#total_purchases').html(purchasePrice);

                },
            });
        });

//add-inventory
        $(document).on('click', '#add-inventory', function (e) {
            var formData = $('#addewinventoryfrom').serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/addnewstock")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {
                    $('#addewinventoryfrom').reset();
                    $('#addinventoryModal').modal('hide');
                },
            });
        })

//ajax call for add option value
        $(document).on('click', '.add-value', function (e) {
            $("#loader").show();
            var parentFrom = $(this).parent('.addvalue-form');
            var language_id = parentFrom.children('#language_id').val();
            var products_options_id = parentFrom.children('#products_options_id').val();
            var formData = parentFrom.serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attributes/options/values/addattributevalue")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {
                    $('.addError').hide();
                    $('#addAttributeModal').modal('hide');
                    $("#content_" + products_options_id + '_' + language_id).parent('tbody').html(res);
                },
            });

        });

//ajax call for add option value
        $(document).on('click', '.update-value', function (e) {
            $("#loader").show();
            var parentFrom = $(this).parent('.editvalue-form');
            var language_id = parentFrom.children('#language_id').val();
            var products_options_id = parentFrom.children('#products_options_id').val();
            var formData = parentFrom.serialize();
            console.log('language_id: ' + language_id);
            console.log('products_options_id: ' + products_options_id);
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attributes/options/values/updateattributevalue")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {
                    $('.addError').hide();

                    $("#content_" + products_options_id + '_' + language_id).parent('tbody').html(res);
                },
            });

        });


//deleteattribute
        $(document).on('click', '#deleteAttribute', function (e) {
            $("#loader").show();
            var parentFrom = $('#deleteValue');
            var language_id = parentFrom.children('#delete_language_id').val();
            var products_options_id = parentFrom.children('#delete_products_options_id').val();
            var formData = parentFrom.serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attributes/options/values/delete")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {
                    $('.addError').hide();

                    $("#content_" + products_options_id + '_' + language_id).parent('tbody').html(res);
                    $('#deleteValueModal').modal('hide');
                    location.reload();
                },
            });

        });

//ajax call for submit value
        $(document).on('click', '#addAttribute', function (e) {
            $("#loader").show();
            var formData = $('#addattributefrom').serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/add")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {

                    if (res.length != '') {
                        $('.addError').hide();
                        $('#addAttributeModal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td>" + res[i].price_prefix + " " + res[i].options_values_price + "</td><td>    <a class='badge bg-light-blue editproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "'  language_id = '" + res[i].language_id + "' options_id= '" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

                        }
                        $(".contentAttribute").html(showData);

                    } else {
                        $('.addError').show();
                    }
                },
            });
        });


//ajax call for submit value
        $(document).on('click', '#addDefaultAttribute', function (e) {
            $("#loader").show();
            var formData = $('#adddefaultattributefrom').serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attach/attribute/default")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {

                    if (res.length != '') {
                        $('.addError').hide();
                        $('#adddefaultattributesmodal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td><a class='badge bg-light-blue editdefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' language_id ='" + res[i].language_id + "' options_id ='" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deletedefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

                        }
                        $(".contentDefaultAttribute").html(showData);

                    } else {
                        $('.addDefaultError').show();
                    }


                },
            });


        });

//onchange get zones agains country
        $(document).on('change', '#entry_country_id', function (e) {

            var zone_country_id = $(this).val();
            $.ajax({
                url: "<?php echo e(URL::to('admin/getZones')); ?>",
                dataType: 'json',
                type: "post",
                // data: '&zone_country_id='+zone_country_id,
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "country_zone_id": zone_country_id,
                },
                success: function (data) {
                    if (data.data.length > 0) {
                        var i;
                        var showData = [];
                        for (i = 0; i < data.data.length; ++i) {
                            showData[i] = "<option value='" + data.data[i].zone_id + "'>" + data.data[i].zone_name + "</option>";

                        }
                        $('.selectstate').show();

                    } else {
                        showData = "<option value=''></option>"
                        $('.selectstate').hide();
                        $('.otherstate').show();

                    }


                    $(".zoneContent").html(showData);


                }
            });

        });
// $(document).on('click','#entry_zone_id',function () {
//
//
//     alert('farhan');
//     $('.otherstate').show();
//
//
// });

//ajax call for submit value
        $(document).on('click', '#addAddress', function (e) {
            $("#loader").show();
            var formData = $('#addAddressFrom').serialize();
            var error = "";

            //to validate text field
            $(".field-validate").each(function () {

                if (this.value == '') {
                    $(this).closest(".form-group").addClass('has-error');
                    //$(this).next(".error-content").removeClass('hidden');
                    error = "has error";
                } else {
                    $(this).closest(".form-group").removeClass('has-error');
                    //$(this).next(".error-content").addClass('hidden');


                }
            });
            if (error == "") {
                $.ajax({
                    url: "<?php echo e(url('admin/customers/addcustomeraddress')); ?>",
                    type: "POST",
                    data: formData,
                    async: false,
                    success: function (res) {

                        if (res.length != '') {
                            $('#addAdressModal').modal('hide');
                            var i;
                            var showData = [];
                            for (i = 0; i < res.length; ++i) {
                                var j = i + 1;

                                showData[i] = "<tr><td>" + j + "</td><td><strong>Company:</strong> " + res[i].entry_company + "<br><strong> Name:</strong> " + res[i].name + "</td><td><strong>Street:</strong> " + res[i].entry_street_address + "<br><strong>Suburb:</strong> " + res[i].entry_suburb + "<br><strong>City:</strong> " + res[i].entry_city + "<br><strong>State:</strong> " + res[i].entry_state + "<br><strong>Zone:</strong> " + res[i].zone_name + "<br><strong>Country:</strong> " + res[i].countries_name + "</td><td><a class='badge bg-light-blue editAddressModal' customers_id = '" + res[i].customers_id + "' address_book_id = '" + res[i].address_book_id + "' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a><a customers_id = '" + res[i].customers_id + "' address_book_id = '" + res[i].address_book_id + "' class='badge bg-red deleteAddressModal'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

                            }
                            $(".contentAttribute").html(showData);


                        } else {
                        }
                        location.reload();
                    },
                });
            }
        });

//editAddressModal
        $(document).on('click', '.editAddressModal', function () {
            var user_id = $(this).attr('user_id');
            var address_book_id = $(this).attr('address_book_id');
            $.ajax({
                url: "<?php echo e(url('admin/customers/editaddress')); ?>",
                type: "POST",
                data: '&user_id=' + user_id + '&address_book_id=' + address_book_id,
                success: function (data) {
                    $('.editContent').html(data);
                    $('#editAddressModal').modal('show');
                },
                dataType: 'html'
            });
        });


//editproductattributemodal
        $(document).on('click', '.editproductattributemodal', function () {
            var products_id = $(this).attr('products_id');
            var products_attributes_id = $(this).attr('products_attributes_id');
            var language_id = $(this).attr('language_id');
            var options_id = $(this).attr('options_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/edit")); ?>',
                type: "POST",
                data: '&products_id=' + products_id + '&products_attributes_id=' + products_attributes_id + '&language_id=' + language_id + '&options_id=' + options_id,
                success: function (data) {
                    $('.editContent').html(data);
                    $('#editproductattributemodal').modal('show');
                },
                dataType: 'html'
            });
        });

//editdefaultattributemodal
        $(document).on('click', '.editdefaultattributemodal', function () {
            var products_id = $(this).attr('products_id');
            var products_attributes_id = $(this).attr('products_attributes_id');
            var language_id = $(this).attr('language_id');
            var options_id = $(this).attr('options_id');
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/edit')); ?>",
                type: "POST",
                data: '&products_id=' + products_id + '&products_attributes_id=' + products_attributes_id + '&language_id=' + language_id + '&options_id=' + options_id,
                success: function (data) {
                    $('.editDefaultContent').html(data);
                    $('#editdefaultattributemodal').modal('show');
                },
                dataType: 'html'
            });
        });

//udpate address
        $(document).on('click', '#updateAddress', function (e) {

            $("#loader").show();
            var formData = $('#editAddressFrom').serialize();

            //to validate text field
            $(".field-validate").each(function () {

                if (this.value == '') {
                    $(this).closest(".form-group").addClass('has-error');
                    //$(this).next(".error-content").removeClass('hidden');
                    error = "has error";
                } else {
                    $(this).closest(".form-group").removeClass('has-error');
                    //$(this).next(".error-content").addClass('hidden');
                    error = "";

                }
            });

            if (error == "") {

                $.ajax({
                    url: "<?php echo e(url('admin/customers/updateaddress')); ?>",
                    type: "POST",
                    data: formData,


                    success: function (res) {
                        console.log(res);
                        if (res.length != '') {

                            location.reload();

                        } else {
                            $('.addError').show();
                        }


                    },
                });
            }

        });


        $(document).on('click', '#updateProductAttribute', function (e) {
            $("#loader").show();
            var formData = $('#editAttributeFrom').serialize();
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/update")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {

                    if (res.length != '') {
                        $('.addError').hide();
                        $('#editproductattributemodal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td>" + res[i].price_prefix + " " + res[i].options_values_price + "</td><td>    <a class='badge bg-light-blue editproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "'  language_id = '" + res[i].language_id + "'  options_id = '" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' language_id = '" + res[i].language_id + "'  options_id = '" + res[i].options_id + "'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

                        }
                        $(".contentAttribute").html(showData);
                    } else {
                        $('.addError').show();
                    }


                },
            });

        });


        $(document).on('click', '#updateDefaultAttribute', function (e) {
            $("#loader").show();
            var formData = $('#editDefaultAttributeFrom').serialize();
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/update')); ?>",
                type: "POST",
                data: formData,
                success: function (res) {

                    if (res.length != '') {
                        $('.addError').hide();
                        $('#editdefaultattributemodal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td><a class='badge bg-light-blue editdefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' language_id ='" + res[i].language_id + "' options_id ='" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deletedefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
                        }
                        $(".contentDefaultAttribute").html(showData);
                    } else {
                        $('.addError').show();
                    }


                },
            });

        });


        //deleteAddressModal
        $(document).on('click', '#deleteSliderId', function () {
            var sliders_id = $(this).attr('sliders_id');
            $('#sliders_id').val(sliders_id);
            $('#deleteSliderModal').modal('show');
        });

        //deleteAddressModal
        $(document).on('click', '.deleteAddressModal', function () {
            var customers_id = $(this).attr('customers_id');
            var address_book_id = $(this).attr('address_book_id');
            $('#customers_id').val(customers_id);
            $('#address_book_id').val(address_book_id);
            $('#deleteAddressModal').modal('show');
        });

        $('#customers_dob').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            endDate: "today"
        });

        //deleteAddress
        // $(document).on('click', '#deleteAddressBtn', function(){
        // 	$("#loader").show();
        // 	var formData = $('#deleteAddress').serialize();
        // 	console.log(formData);
        // 	$.ajax({
        // 		url: "<?php echo e(URL::to('admin/customers/deleteAddress')); ?>",
        // 		type: "POST",
        // 		data: formData,
        // 		success: function (res) {
        // 			//$('.deleteEmbed').html(res);
        // 			//alert(res);
        // 			$('#deleteAddressModal').modal('hide');
        // 			if(res.length != ''){
        // 				var i;
        // 				var showData = [];
        // 				for (i = 0; i < res.length; ++i) {

        // 				var j = i + 1;
        // 				showData[i] = "<tr><td>"+j+"</td><td><strong>Company:</strong> "+res[i].entry_company+"<br><strong>First Name:</strong> "+res[i].entry_firstname+"<br><strong>Last Name:</strong> "+res[i].entry_lastname+"</td><td><strong>Street:</strong> "+res[i].entry_street_address+"<br><strong>Suburb:</strong> "+res[i].entry_suburb+"<br><strong>Postcode:</strong> "+res[i].entry_postcode+"<br><strong>City:</strong> "+res[i].entry_city+"<br><strong>State:</strong> "+res[i].entry_state+"<br><strong>Zone:</strong> "+res[i].zone_name+"<br><strong>Country:</strong> "+res[i].countries_name+"</td><td><a class='badge bg-light-blue editAddressModal' customers_id = '"+res[i].customers_id+"' address_book_id = '"+res[i].address_book_id+"' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a><a customers_id = '"+res[i].customers_id+"' address_book_id = '"+res[i].address_book_id+"' class='badge bg-red deleteAddressModal'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

        // 				}
        // 				//$(".contentAttribute").html(showData);

        // 			}else{
        // 				var showData = "<tr><td colspan='5'><strong>No record found!</strong> Please click on '<strong>Add Address</strong>' to add address.</td></tr>";
        // 			}
        // 				$(".contentAttribute").html(showData);
        // 		},
        // 	});
        // });

        //device id
        /*$(document).on('click', '#deletedeviceId', function(){
		var devices_id = $(this).attr('devices_id');
		$('#devices_id').val(devices_id);
		$('#deletedeviceModal').modal('show');
	})

	//DeviceDeletedMessage
	$(document).on('click', '.deleteproductattributemodal', function(){
		var products_id = $(this).attr('products_id');
		var products_attributes_id = $(this).attr('products_attributes_id');
		$.ajax({
			url: ""

        ",
			type: "POST",
			data: '&products_id='+products_id+'&products_attributes_id='+products_attributes_id,
			success: function (data) {
				$('.deleteEmbed').html(data);
				$('#deleteproductattributemodal').modal('show');
			},
			dataType: 'html'
		});
	});*/


        //deleteproductattributemodal
        $(document).on('click', '.deleteproductattributemodal', function () {
            var products_id = $(this).attr('products_id');
            var products_attributes_id = $(this).attr('products_attributes_id');
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/options/showdeletemodal')); ?>",
                type: "POST",
                data: '&products_id=' + products_id + '&products_attributes_id=' + products_attributes_id,
                success: function (data) {
                    $('.deleteEmbed').html(data);
                    $('#deleteproductattributemodal').modal('show');
                },
                dataType: 'html'
            });
        });

        //deletedefaultattributemodal
        $(document).on('click', '.deletedefaultattributemodal', function () {
            var products_id = $(this).attr('products_id');
            var products_attributes_id = $(this).attr('products_attributes_id');
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/deletedefaultattributemodal')); ?>",
                type: "POST",
                data: '&products_id=' + products_id + '&products_attributes_id=' + products_attributes_id,
                success: function (data) {
                    $('.deleteDefaultEmbed').html(data);
                    $('#deletedefaultattributemodal').modal('show');
                },
                dataType: 'html'
            });
        });

        //deleteOption
        $(document).on('click', '.deleteOption', function () {
            $("#loader").show();
            var option_id = $(this).attr('option_id');
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attributes/options/values/checkattributeassociate')); ?>",
                type: "POST",
                data: '&option_id=' + option_id,
                success: function (res) {
                    if (res.length != '') {
                        $('.addError').hide();
                        $("#assciate-products").html(res);
                        $('#productListModal').modal('show');
                    } else {
                        $('#option_id').val(option_id);
                        $('#productListModal').modal('hide');
                        $('#deleteattributeModal').modal('show');
                        $(".contentAttribute").html(res);
                    }
                },
            });
        });

        // delete-value
        $(document).on('click', '.delete-value', function () {
            $("#loader").show();
            var value_id = $(this).attr('value_id');
            var delete_products_options_id = $(this).attr('option_id');
            var delete_language_id = $(this).attr('language_id');
            //alert(delete_language_id);
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attributes/options/values/checkvalueassociate')); ?>",
                type: "POST",
                data: '&value_id=' + value_id,
                success: function (res) {
                    //$('.deleteEmbed').html(res);
                    //alert(res);
                    if (res.length != '') {
                        $('.addError').hide();
                        $("#assciate-products-value").html(res);
                        $('#productListModalValue').modal('show');
                    } else {
                        $('#value_id').val(value_id);
                        $('#delete_products_options_id').val(delete_products_options_id);
                        $('#delete_language_id').val(delete_language_id);
                        $('#productListModalValue').modal('hide');
                        $('#deleteValueModal').modal('show');
                        $(".contentAttribute").html(res);

                    }


                },
            });
        });

        //deleteProductAttribute
        $(document).on('click', '#deleteProductAttribute', function () {
            $("#loader").show();
            var formData = $('#deleteattributeform').serialize();
            console.log(formData);
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/delete')); ?>",
                type: "POST",
                data: formData,
                success: function (res) {
                    //$('.deleteEmbed').html(res);
                    //alert(res);
                    if (res.length != '') {
                        $('.addError').hide();
                        $('#deleteproductattributemodal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td>" + res[i].price_prefix + " " + res[i].options_values_price + "</td><td>    <a class='badge bg-light-blue editproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "'  language_id = '" + res[i].language_id + "'  options_id = '" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteproductattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' language_id = '" + res[i].language_id + "'  options_id = '" + res[i].options_id + "'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
                        }

                        $(".contentAttribute").html(showData);
                    } else {

                        $('#deleteproductattributemodal').modal('hide');
                        $('.addError').show();
                        $(".contentAttribute").html(res);
                    }
                },
            });
        });


        //deletedefaultattributemodal
        $(document).on('click', '#deleteDefaultAttribute', function () {
            $("#loader").show();
            var formData = $('#deletedefaultattributeform').serialize();
            console.log(formData);
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/attach/attribute/default/delete')); ?>",
                type: "POST",
                data: formData,
                success: function (res) {
                    //$('.deleteEmbed').html(res);
                    //alert(res);
                    if (res.length != '') {
                        $('.addError').hide();
                        $('#deletedefaultattributemodal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td>" + res[i].products_options_name + "</td><td>" + res[i].products_options_values_name + "</td><td><a class='badge bg-light-blue editdefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "'  products_id = '" + res[i].products_id + "' language_id ='" + res[i].language_id + "' options_id ='" + res[i].options_id + "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deletedefaultattributemodal' products_attributes_id = '" + res[i].products_attributes_id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
                        }

                        $(".contentDefaultAttribute").html(showData);
                    } else {

                        $('#deletedefaultattributemodal').modal('hide');
                        $('.addDefaultError').show();
                        $(".contentDefaultAttribute").html(res);
                    }
                },
            });
        });

        //ajax call for submit value
        $(document).on('click', '#addImage', function (e) {
            $("#loader").show();
            var formData = new FormData($('#addImageFrom')[0]);
            $.ajax({
                url: '<?php echo e(URL::to("admin/addnewproductimage")); ?>',
                type: "POST",
                data: formData,
                success: function (res) {
                    if (res.length != '') {
                        $('.addError').hide();
                        $('#addImagesModal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td><img src=<?php echo e(asset('').'/'); ?>" + res[i].image + " alt='' width=' 100px'></td><td>" + res[i].htmlcontent + "</td> <td><a products_id = '" + res[i].products_id + "' class='badge bg-light-blue editProductImagesModal' id = '" + res[i].id + "' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '" + res[i].id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
                        }
                        $(".contentImages").html(showData);
                    } else {
                        $('.addError').show();
                    }


                },
                cache: false,
                contentType: false,
                processData: false
            });


        });

        //website_themes
        $(document).on('click', '.website_themes', function () {
            //$('.applied_message').attr('hidden','hidden');
            var theme_id = $(this).val();
            $.ajax({
                url: '<?php echo e(URL::to("admin/updateWebTheme")); ?>',
                type: "POST",
                data: '&theme_id=' + theme_id,
                success: function (data) {
                    if (data == 'success') {
                        $('.applied_message').removeAttr('hidden');
                    }
                },
                dataType: 'html'
            });
        });


        //editproductimagesmodal
        $(document).on('click', '.editProductImagesModal', function () {
            var id = $(this).attr('id');
            var products_id = $(this).attr('products_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/editproductimage")); ?>',
                type: "POST",
                data: '&products_id=' + products_id + '&id=' + id,
                success: function (data) {
                    $('.editImageContent').html(data);
                    $('#editProductImagesModal').modal('show');
                },
                dataType: 'html'
            });
        });


        $(document).on('click', '#updateProductImage', function (e) {
            $("#loader").show();
            var formData = new FormData($('#editImageFrom')[0]);
            $.ajax({
                url: "<?php echo e(URL::to('admin/updateproductimage')); ?>",
                type: "POST",
                data: formData,
                success: function (res) {
                    if (res.length != '') {
                        $('.addError').hide();
                        $('#editProductImagesModal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td><img src=<?php echo e(asset('').'/'); ?>" + res[i].image + " alt='' width=' 100px'></td><td>" + res[i].htmlcontent + "</td> <td><a products_id = '" + res[i].products_id + "' class='badge bg-light-blue editProductImagesModal' id = '" + res[i].id + "' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '" + res[i].id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

                        }
                        $(".contentImages").html(showData);
                    } else {
                        $('.addError').show();
                    }


                },
                cache: false,
                contentType: false,
                processData: false
            });

        });

        $("#sendNotificaionForm").submit(function () {
            $('.not-sent').addClass('hide');
            $('.sent-push').addClass('hide');
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo e(URL::to('admin/devices/notifyUser')); ?>",
                type: "POST",
                data: formData,
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,
                success: function (res) {
                    $('.sent-push').addClass('hide');
                    $('.not-sent').addClass('hide');
                    if ($.trim(res) == '1') {
                        $('.sent-push').removeClass('hide');
                    } else {
                        $('.not-sent').removeClass('hide');
                    }
                },
            });

            return false;

        });

        //send-notificaion
        $(document).on('click', '#single-notificaion', function () {
            $('.not-sent').addClass('hide');
            $('.sent-push').addClass('hide');
            var formData = new FormData($('#sendNotificaionForm')[0]);

            $.ajax({
                url: "<?php echo e(URL::to('admin/devices/notifyUser')); ?>",
                type: "POST",
                data: formData,
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,
                success: function (res) {
                    $('.sent-push').addClass('hide');
                    $('.not-sent').addClass('hide');
                    if ($.trim(res) == '1') {
                        $('.sent-push').removeClass('hide');
                    } else {
                        $('.not-sent').removeClass('hide');
                    }
                },
            });

            return false;

        });


        //send push Notification
        $(document).on('click', '#sendd-notificaion', function () {
            $('.not-sent').addClass('hide');
            $('.sent-push').addClass('hide');
            var title = $('#title').val();
            var message = $('#message').val();

            var form = $('#sendNotificaionForm')[0]; // You need to use standard javascript object here
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo e(URL::to('admin/devices/notifyUser')); ?>",
                type: "POST",
                data: formData,
                //contentType: true,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,
                success: function (res) {
                    $('.sent-push').addClass('hide');
                    $('.not-sent').addClass('hide');
                    if ($.trim(res) == '1') {
                        $('.sent-push').removeClass('hide');
                    } else {
                        $('.not-sent').removeClass('hide');
                    }
                },
            });

        });

        //deleteProductImagesModal
        $(document).on('click', '.deleteProductImagesModal', function () {
            var id = $(this).attr('id');
            var products_id = $(this).attr('products_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/products/images/deleteproductimagemodal")); ?>',
                type: "POST",
                data: '&products_id=' + products_id + '&id=' + id,
                success: function (data) {
                    $('.deleteImageEmbed').html(data);
                    $('#deleteProductImageModal').modal('show');
                },
                dataType: 'html'
            });
        });

        //deleteproductimage
        $(document).on('click', '#deleteProductImage', function () {
            $("#loader").show();
            var formData = $('#deleteImageForm').serialize();
            $.ajax({
                url: "<?php echo e(URL::to('admin/products/images/deleteproductimage')); ?>",
                type: "POST",
                data: formData,
                success: function (res) {
                    if (res.length != '') {
                        $('.addError').hide();
                        $('#deleteProductImageModal').modal('hide');
                        var i;
                        var showData = [];
                        for (i = 0; i < res.length; ++i) {
                            var j = i + 1;
                            showData[i] = "<tr><td>" + j + "</td><td><img src=<?php echo e(asset('').'/'); ?>" + res[i].image + " alt='' width=' 100px'></td><td>" + res[i].htmlcontent + "</td> <td><a products_id = '" + res[i].products_id + "' class='badge bg-light-blue editProductImagesModal' id = '" + res[i].id + "' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '" + res[i].id + "' products_id = '" + res[i].products_id + "' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
                        }
                        $(".contentImages").html(showData);
                    } else {
                        var showData = '<tr><td colspan="4"><strong>No record found!</strong> Please click on "<strong>Add Product Images</strong>" to add images.</td></tr>';
                        $('#deleteProductImageModal').modal('hide');
                        $(".contentImages").html(showData);
                    }
                },
            });
        });


        //ajax call for notification pop
        $(document).on('click', '#notification-popup', function () {
            var customers_id = $(this).attr('customers_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/devices/customerNotification")); ?>',
                type: "POST",
                data: '&customers_id=' + customers_id,
                success: function (data) {
                    $('.notificationContent').html(data);
                    $('#notificationModal').modal('show');
                },
                dataType: 'html'
            });
        });

        //ajax call for manage role
        $(document).on('click', '.manage-role-popup', function () {
            var user_types_id = $(this).attr('user_types_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/managerolepopup")); ?>',
                type: "POST",
                data: '&customers_id=' + customers_id,
                success: function (data) {
                    $('#manage-role-content').html(data);
                    $('#manageRoleModal').modal('show');
                },
                dataType: 'html'
            });
        });

        //get products for coupon
        $(document).on('focus', '.couponProdcuts input', function () {
            var products = $(this).attr('products_id');
            $.ajax({
                url: "<?php echo e(URL::to('admin/couponProducts')); ?>",
                type: "POST",
                data: '',
                success: function (data) {
                },
                dataType: 'html'
            });
        });

        //call function on window load
        <?php if(Request::path() == 'admin/editproduct/*'): ?>
        getSubCategory();
        <?php endif; ?>
        //special product
        showSpecial();
        showFlash();
        prodcust_type();
        //deleteproductmodal
        $(document).on('click', '#deleteProductId', function () {
            var products_id = $(this).attr('products_id');
            $('#products_id').val(products_id);
            $("#deleteproductmodal").modal('show');
        });

        //deleteattributeModal
        $(document).on('click', '#deleteattributeFrom', function () {
            var option_id = $(this).attr('option_id');
            $('#option_id').val(option_id);
            $("#deleteattributeModal").modal('show');
        });


        //deleteCustomerModal
        $(document).on('click', '#deleteCustomerFrom', function () {
            var users_id = $(this).attr('users_id');
            $('#users_id').val(users_id);
            $("#deleteCustomerModal").modal('show');
        });

        //deletemanufacturerModal
        $(document).on('click', '#manufacturerFrom', function () {
            var manufacturers_id = $(this).attr('manufacturers_id');
            $('#manufacturers_id').val(manufacturers_id);
            $("#manufacturerModal").modal('show');
        });

        //deleteCountrytModal
        $(document).on('click', '#deleteCountryId', function () {
            var countries_id = $(this).attr('countries_id');
            $('#countries_id').val(countries_id);
            $("#deleteCountryModal").modal('show');
        });

        //deleteZoneModal
        $(document).on('click', '#deletezoneId', function () {
            var zone_id = $(this).attr('zone_id');
            $('#zone_id').val(zone_id);
            $("#deleteZoneModal").modal('show');
        });

        //deleteTaxClassModal
        $(document).on('click', '#deleteTaxClassId', function () {
            var tax_class_id = $(this).attr('tax_class_id');
            $('#tax_class_id').val(tax_class_id);
            $("#deleteTaxClassModal").modal('show');
        });

        //deleteTaxRateModal
        $(document).on('click', '#deleteTaxRateId', function () {
            var tax_rates_id = $(this).attr('tax_rates_id');
            $('#tax_rates_id').val(tax_rates_id);
            $("#deleteTaxRateModal").modal('show');
        });

        //deleteOrderStatusModal
        $(document).on('click', '#deleteOrderStatusId', function () {
            var orders_status_id = $(this).attr('orders_status_id');
            $('#orders_status_id').val(orders_status_id);
            $("#deleteOrderStatusModal").modal('show');
        });


        //deletelanguageModal
        $(document).on('click', '#deleteLanguageId', function () {
            var languages_id = $(this).attr('languages_id');
            $('#languages_id').val(languages_id);
            $("#deleteLanguagesModal").modal('show');
        });

        //deleteTaxRateModal
        $(document).on('click', '#deleteCoupans_id', function () {
            var coupans_id = $(this).attr('coupans_id');
            $('#coupans_id').val(coupans_id);
            $("#deleteCoupanModal").modal('show');
        });

        //deleteTaxClassModal
        $(document).on('click', '#deleteBannerId', function () {
            var banners_id = $(this).attr('banners_id');
            $('#banners_id').val(banners_id);
            $("#deleteBannerModal").modal('show');
        });

        $(document).on('click', '#delete', function () {
            var category_id = $(this).attr('category_id');
            $('#category_id').val(category_id);
            $("#deleteModal").modal('show');
        });


        // deleteNewsCategoryModal
        $(document).on('click', '#deleteNewsCategroyId', function () {
            var id = $(this).attr('category_id');
            $('#id').val(id);
            $("#deleteNewsCategoryModal").modal('show');
        });

        //deleteNewsModal
        $(document).on('click', '#deleteNewsId', function () {
            var id = $(this).attr('news_id');
            $('#id').val(id);
            $("#deleteNewsModal").modal('show');
        });

        //deleteModal
        $(document).on('click', '#deleteModelId', function () {
            var record_id = $(this).attr('record_id');
            $('#record_id').val(record_id);
            $("#deleteModal").modal('show');
        });

        //deletePageModal
        $(document).on('click', '#deletePageId', function () {
            var id = $(this).attr('page_id');
            $('#id').val(id);
            $("#deletePageModal").modal('show');
        });

        //deleteTaxClassModal
        $(document).on('click', '#deleteOrdersId', function () {
            var orders_id = $(this).attr('orders_id');
            $('#orders_id').val(orders_id);
            $("#deleteModal").modal('show');
        });


        //edit option value
        $(document).on('click', '.edit-value', function () {
            var value = $(this).attr('value');
            $(".form-p-" + value).hide();
            $(".form-content-" + value).show();
        });

        //cancel option value
        $(document).on('click', '.cancel-value', function () {
            var value = $(this).attr('value');
            $(".form-content-" + value).hide();
            $(".form-p-" + value).show();
        });

        //deleteUnitModal
        $(document).on('click', '#deleteUnitsId', function () {
            var unit_id = $(this).attr('unit_id');
            $('#unit_id').val(unit_id);
            $("#deleteUnitModal").modal('show');
        });

        //getRange
        $(document).on('click', '.getRange', function () {
            var dateRange = $('.dateRange').val();
            if (dateRange != '') {
                $('.dateRange').parent('.input-group').removeClass('has-error');
                dateRange = dateRange.replace(/-/g, "_");
                dateRange = dateRange.replace(/\//g, "-");
                dateRange = dateRange.replace(/ /g, "");
                window.location = "<?php echo e(URL::to('admin/dashboard/dateRange=')); ?>" + dateRange;
            } else {
                $('.dateRange').parent('.input-group').addClass('has-error');
            }
        });

        //default_method
        $(document).on('click', '.default_method', function () {
            var shipping_id = $(this).attr('shipping_id');
            $.ajax({
                url: '<?php echo e(URL::to("admin/defaultShippingMethod")); ?>',
                type: "POST",
                data: '&shipping_id=' + shipping_id,
                success: function (data) {
                    $('.default-div').removeClass('hidden');
                },
            });
        });

        //product options language
        $(document).on('change', '.language_id', function () {
            var language_id = $(this).val();
            getOptions(language_id);
        });

        //product options option with language id
        $(document).on('change', '.default-option-id', function () {
            var option_id = $(this).val();
            getOptionsValue(option_id);
        });

        //product options language
        $(document).on('change', '.edit_language_id', function () {
            var language_id = $(this).val();
            getEditOptions(language_id);
        });

        //product options option with language id
        $(document).on('change', '.edit-default-option-id', function () {
            var option_id = $(this).val();
            getEditOptionsValue(option_id);
        });

        //product options language
        $(document).on('change', '.additional_language_id', function () {
            var language_id = $(this).val();
            getAdditionalOptions(language_id);
        });

        //product options option with language id
        $(document).on('change', '.additional-option-id', function () {
            var option_id = $(this).val();
            getAdditionalOptionsValue(option_id);
        });

        //product options language
        $(document).on('change', '.edit_additional_language_id', function () {
            var language_id = $(this).val();
            getEditAdditionalOptions(language_id);
        });

        //product options option with language id
        $(document).on('change', '.edit-additional-option-id', function () {
            var option_id = $(this).val();
            getEditAdditionalOptionsValue(option_id);
        });


        //default_language
        $(document).on('click', '.default_language', function () {
            var languages_id = $(this).val();
            $.ajax({
                url: '<?php echo e(URL::to("admin/languages/default")); ?>',
                type: "POST",
                data: '&languages_id=' + languages_id,
                success: function (data) {
                    location.reload();
                },
            });
        });

        $(document).on('click', '.default_pay_method', function () {
            var method_id = $(this).val();
            $.ajax({
                url: '<?php echo e(URL::to("admin/paymentmethods/active")); ?>',
                type: "POST",
                data: '&method_id=' + method_id,
                success: function (data) {
                    location.reload();
                },
            });
        });


    });

    // function getOptions(languages_id) {
    // 	$.ajax({
    // 		url: '<?php echo e(URL::to("admin/getOptions")); ?>',
    // 		type: "POST",
    // 		data: '&languages_id='+languages_id,
    // 		success: function (data) {
    // 			$('.default-option-id').html(data);
    // 		},
    // 	});
    // }


    function getOptionsValue(option_id) {
        var language_id = $('.language_id').val();
        $.ajax({
            url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/getOptionsValue")); ?>',
            type: "POST",
            data: '&option_id=' + option_id + '&language_id=' + language_id,
            success: function (data) {
                $('.products_options_values_id').html(data);
            },
        });
    }

    // function getEditOptions(languages_id) {
    // 	$.ajax({
    // 		url: '<?php echo e(URL::to("admin/getOptions")); ?>',
    // 		type: "POST",
    // 		data: '&languages_id='+languages_id,
    // 		success: function (data) {
    // 			$('.edit-default-option-id').html(data);
    // 		},
    // 	});
    // }


    function getEditOptionsValue(option_id) {

        var language_id = $('.edit_language_id').val();
        $.ajax({
            url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/getOptionsValue")); ?>',
            type: "POST",
            data: '&option_id=' + option_id + '&language_id=' + language_id,
            success: function (data) {
                $('.edit-products_options_values_id').html(data);
            },
        });
    }

    // function getAdditionalOptions(languages_id) {
    // 	$.ajax({
    // 		url: '<?php echo e(URL::to("admin/getOptions")); ?>',
    // 		type: "POST",
    // 		data: '&languages_id='+languages_id,
    // 		success: function (data) {
    // 			$('.additional-option-id').html(data);
    // 		},
    // 	});
    // }


    function getAdditionalOptionsValue(option_id) {

        var language_id = $('.additional_language_id').val();
        $.ajax({
            url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/getOptionsValue")); ?>',
            type: "POST",
            data: '&option_id=' + option_id + '&language_id=' + language_id,
            success: function (data) {
                $('.additional_products_options_values_id').html(data);
            },
        });
    }

    // function getEditAdditionalOptions(languages_id) {
    // 	$.ajax({
    // 		url: '<?php echo e(URL::to("admin/getOptions")); ?>',
    // 		type: "POST",
    // 		data: '&languages_id='+languages_id,
    // 		success: function (data) {
    // 			$('.edit-additional-option-id').html(data);
    // 		},
    // 	});
    // }


    function getEditAdditionalOptionsValue(option_id) {

        var language_id = $('.edit_additional_language_id').val();
        $.ajax({
            url: '<?php echo e(URL::to("admin/products/attach/attribute/default/options/getOptionsValue")); ?>',
            type: "POST",
            data: '&option_id=' + option_id + '&language_id=' + language_id,
            success: function (data) {
                $('.edit-additional-products_options_values_id').html(data);
            },
        });
    }

    //getSubCategory
    function getSubCategory() {

            <?php if(Request::path() == 'admin/addProduct'): ?>
        var getCategories = '<?php echo e(URL::to("admin/getajaxcategories")); ?>';

            <?php else: ?>

        var getCategories = '<?php echo e(URL::to("admin/getajaxcategories")); ?>';
            <?php endif; ?>

        var category_id = $('#category_id').val();
        if (category_id != '') {
            $.ajax({
                url: getCategories,
                type: "POST",
                data: '&category_id=' + category_id,
                success: function (data) {
                    if (data.length != '') {
                        var i;
                        var showData = [];
                        for (i = 0; i < data.length; ++i) {
                            showData[i] = "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                        }
                        $("#sub_category_id").html(showData);
                    } else {
                        $("#sub_category_id").html("<option value=''>Please Select</option>");
                    }
                },
            });
        }
    }

    function showAvailtime() {
        if ($('#showAvailTime').val() == 'yes') {
            $(".available-container").show();
            $(".available-container .availtime").addClass("field-validate");
        } else {
            $(".available-container").hide();
            $(".available-container .availtime").removeClass("field-validate");
        }
    }

    //showSpecial
    function showSpecial() {
        if ($('#isSpecial').val() == 'yes') {
            $(".special-container").show();
            $(".special-container input#expiry-date").addClass("field-validate");
            $(".special-container input#special-price").addClass("number-validate");

        } else {
            $(".special-container").hide();
            $(".special-container input#expiry-date").removeClass("field-validate");
            $(".special-container input#special-price").removeClass("number-validate");
        }
    }


    //showFlash
    function showFlash() {
        if ($('#isFlash').val() == 'yes') {
            $(".flash-container").show();
            $(".flash-container #flash_sale_products_price").addClass("field-validate");
            $(".flash-container #flash_start_date").addClass("field-validate");
            //$(".flash-container #flash_start_time").addClass("field-validate");
            $(".flash-container #flash_expires_date").addClass("field-validate");
            //$(".flash-container #flash_end_time").addClass("field-validate");

        } else {
            $(".flash-container").hide();
            $(".flash-container #flash_sale_products_price").removeClass("field-validate");
            $(".flash-container #flash_start_date").removeClass("field-validate");
            //$(".flash-container #flash_start_time").removeClass("field-validate");
            $(".flash-container #flash_expires_date").removeClass("field-validate");
            //$(".flash-container #flash_end_time").removeClass("field-validate");
        }
    }


    $(function () {
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

    });


    function banner_type() {
        var type = $(this).val();
        if (type == 'category') {
            $('.categoryContent').show();
            $('.productContent').hide();
        } else if (type == 'product') {
            $('.categoryContent').hide();
            $('.productContent').show();
        } else {
            $('.categoryContent').hide();
            $('.productContent').hide();
        }
    }

    $(document).on('change', '.choseOption', function () {

        var content = $(this).attr('content');
        var choseOption = $(this).val();
        console.log(choseOption);

        if (choseOption == 'new') {
            $('.field-validate_' + content).addClass('field-validate');
            $('.newAttribute_' + content).show();
            $('.oldAttribute_' + content).hide();
        } else if (choseOption == 'old') {
            $('.field-validate_' + content).removeClass('field-validate');
            $('.newAttribute_' + content).hide();
            $('.oldAttribute_' + content).show();
        }

    });


    $(document).ready(function (e) {
        $('#bannerType').change(bannerstypes);
        bannerstypes();

        function bannerstypes() {
            var type = $('#bannerType').val();
            $('#categories_id').removeClass('field-validate');
            $('#products_id').removeClass('field-validate');

            if (type == 'category') {
                $('.categoryContent').show();
                $('.productContent').hide();
                $('#categories_id').addClass('field-validate');
            } else if (type == 'product') {
                $('.categoryContent').hide();
                $('.productContent').show();
                $('#products_id').addClass('field-validate');
            } else {
                $('.categoryContent').hide();
                $('.productContent').hide();
            }
        }
    });

    $(document).on('change', '#bannerType', function (e) {
        var type = $(this).val();


    });


    $(document).on('click', '.notifyTo', function (e) {

        if ($(this).is(':checked')) {
            $('.device_id > input').attr('disabled', true);
        } else {
            $('.device_id > input').removeAttr('disabled');
        }
    });

    $(document).on('submit', '.form-validate-level', function (e) {

        var error = "";
        $(".number-validate-level").each(function () {
            if (this.value == '' || isNaN(this.value)) {
                $(this).closest(".form-group").addClass('has-error');
                error = "has error";
            } else {
                $(this).closest(".form-group").removeClass('has-error');
            }
        });

        $(".check_reference_id").each(function () {
            if (this.value == '') {
                $("#minmax-error").show();
                error = "has error";
            } else {
                $("#minmax-error").hide();
            }
        });

        if (error == "has error") {
            return false;
        }
    });

    //focus form field
    $(document).on('keyup', '.number-validate-level', function (e) {

        if (this.value == '' || isNaN(this.value)) {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
        } else {
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');
        }

    });


    //validate form
    $(document).on('submit', '.form-validate', function (e) {
        var error = "";

        //to validate text field
        $(".field-validate").each(function () {

            if (this.value == '') {
                var parent_id = $(this).parents('.tab-pane').attr('id');
                if (parent_id != undefined) {
                    $("[href='#" + parent_id + "']").css('color', 'red');
                    var position = $("[href='#" + parent_id + "']").offset().top;
                    $("body, html").animate({
                        scrollTop: position
                    } /* speed */);
                }
                $(this).closest(".form-group").addClass('has-error');
                //$(this).next(".error-content").removeClass('hidden');
                error = "has error";
            } else {
                $(this).closest(".form-group").removeClass('has-error');
                //$(this).next(".error-content").addClass('hidden');


            }


        });


        $(".required_one").each(function () {
            var checked = $('.required_one:checked').length;
            if (!checked) {
                $(this).closest(".form-group").addClass('has-error');
                error = "has error";
            } else {
                $(this).closest(".form-group").removeClass('has-error');
            }
        });

        $(".number-validate").each(function () {
            if (this.value == '' || isNaN(this.value)) {
                $(this).closest(".form-group").addClass('has-error');
                //$(this).next(".error-content").removeClass('hidden');
                error = "has error";
            } else {
                $(this).closest(".form-group").removeClass('has-error');
                //$(this).next(".error-content").addClass('hidden');
            }
        });

        //
        $(".email-validate").each(function () {
            var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (this.value != '' && validEmail.test(this.value)) {
                $(this).closest(".form-group").removeClass('has-error');
                //$(this).next(".error-content").addClass('hidden');

            } else {
                $(this).closest(".form-group").addClass('has-error');
                //$(this).next(".error-content").removeClass('hidden');
                error = "has error";
            }
        });

        if (error == "has error") {
            return false;
        }

    });

    //focus form field
    $(document).on('keyup change', '.field-validate', function (e) {

        if (this.value == '') {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
        } else {
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');
        }

    });

    $(document).on('click', '.required_one', function (e) {

        var checked = $('.required_one:checked').length;
        if (!checked) {
            $(this).closest(".form-group").addClass('has-error');
        } else {
            $(this).closest(".form-group").removeClass('has-error');
        }

    });


    //focus form field
    $(document).on('keyup', '.number-validate', function (e) {

        if (this.value == '' || isNaN(this.value)) {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
        } else {
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');
        }

    });

    $(document).on('keyup focusout', '.email-validate', function (e) {
        var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (this.value != '' && validEmail.test(this.value)) {
            $(this).closest(".form-group").removeClass('has-error');
            //$(this).next(".error-content").addClass('hidden');

        } else {
            $(this).closest(".form-group").addClass('has-error');
            //$(this).next(".error-content").removeClass('hidden');
            error = "has error";
        }
    });

    //change default notifcation
    $(document).on('change', '#default_notification', function (e) {
        var value = $(this).val();
        if (value == 'fcm') {
            $('.onesignal_content').hide();
            $('.fcm_content').show();
        } else if (value == 'onesignal') {
            $('.fcm_content').hide();
            $('.onesignal_content').show();

        }
    });


    //ajax call for submit value
    $(document).on('click', '#generate-key', function (e) {
        $("#loader").show();
        $('#generateSuccessfully').attr('hidden', 'hidden')
        $.ajax({
            url: '<?php echo e(URL::to("admin/generateKey")); ?>',
            type: "GET",
            async: false,
            success: function (res) {
                $("#loader").hide();
                $('#generateSuccessfully').removeAttr('hidden');
                $('#consumer_key').val(res.consumerKey);
                $("#consumer_secret").val(res.consumerSecret);
            },
        });
    });

    //show password div
    function validatePasswordForm() {
        var email = document.forms["updateAdminPassword"]["email"].value;
        var password = document.forms["updateAdminPassword"]["password"].value;
        var re_password = document.forms["updateAdminPassword"]["re_password"].value;
        var err = '';
        if (password == null || password == "" || password.length < 6) {
            $('#password').closest('.col-sm-10').addClass('has-error');
            $('#password').focus();
            err = "Password must be filled and of more than 6 characters! \n";
            $('#password').next('.error-content').html(err).show();
            return false;
        } else {
            $('#password').closest('.col-sm-10').removeClass('has-error');
            $('#password').next('.error-content').hide();

            if (re_password == null || re_password == '') {
                err = "Please re enter password! \n";
                document.getElementById("re_password").focus();
                $('#re_password').parent('.col-sm-10').addClass('has-error');
                $('#re_password').next('.error-content').html(err).show();
                return false;
            } else {
                if (re_password != password) {
                    err = "Both passwords must be matched! \n";
                    document.getElementById("re_password").focus()
                    $('#re_password').parent('.col-sm-10').addClass('has-error');
                    $('#re_password').next('.error-content').html(err).show();
                    return false;
                } else {
                    var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                    if (email != null && validEmail.test(email)) {
                        $(".form-group-email").removeClass('has-error');
                        return true;
                    } else {
                        $(".form-group-email").addClass('has-error');
                        return false;
                    }

                }
            }
        }
    }

    $(document).on('click', '#change-passowrd', function () {
        if ($(this).is(':checked')) {
            $('#password').addClass('field-validate');
            $('.password').show();
        } else {
            $('.password').hide();
            $('#password').parents('div.form-group').removeClass('has-error');
            $('#password').removeClass('field-validate');
        }
    });

    //prodcust_type
    function prodcust_type() {
        var prodcust_type = $('.prodcust-type').val();

        if (prodcust_type == 2) {

            $('.external_link').show();
            $('.products_url').addClass('field-validate');
            $('.external_link_special').val('no');
            $('.special-link').hide();
            $('#isSpecial').val('no');

            $('.flash-sale-link').hide();
            $('#isFlash').val('no');

            $('#variable-btn').hide();
            $('#simple-btn').hide();
            $('#external-btn').show();
            $('#tax-class').hide();
            showSpecial();
            showFlash();
            showAvailtime();

        } else if (prodcust_type == 1) {

            $('.external_link').hide();
            $('.products_url').removeClass('field-validate');
            $('.special-link').show();
            $('#simple-btn').hide();
            $('#variable-btn').show();
            $('#external-btn').hide();
            $('#tax-class').show();
            $('.flash-sale-link').show();

        } else if (prodcust_type == 0) {
            $('.external_link').hide();
            $('.products_url').removeClass('field-validate');
            $('.special-link').show();
            $('#simple-btn').show();
            $('#variable-btn').hide();
            $('#external-btn').hide();
            $('#tax-class').show();
            $('.flash-sale-link').show();
        }

    }

    $(document).on('change', '.product-type', function () {
        var product_id = $(this).val();
        $.ajax({
            url: '<?php echo e(URL::to("admin/products/inventory/ajax_min_max")); ?>' + '/' + product_id,
            type: "GET",
            success: function (res) {
                //console.log(res.products[0].products_type);
                if (res.products[0].products_type == '0') {
                    $('#inventory_ref_id').val('0');
                } else {
                    $('#inventory_ref_id').val('');
                }

                $('#current_stocks').html(res.stocks);
                $('#total_purchases').html(res.purchase_price);

                if (res.length != '') {
                    $('#min_level').val(res.min_level);
                    $('#max_level').val(res.max_level);
                    $('#purchase_price').val(res.purchase_price);
                    $('#stocks').val(res.stocks);

                } else {
                    $('.addError').show();
                }
            },
        });

        $.ajax({
            url: '<?php echo e(URL::to("admin/products/inventory/ajax_attr")); ?>' + '/' + product_id,
            type: "GET",
            success: function (res) {
                //console.log(res);
                $('#attribute').html(res);
                $('#attribute').show();
                var has_val = $('#has-attribute').val();
                if (has_val == 0) {
                    $('#attribute-btn').hide();
                } else {
                    $('#attribute-btn').show();
                }
            },
        });


    });


    function cancelOrder() {
        var status_id = $("#status_id").val();
        if (status_id == 3) {
            if (confirm("<?php echo app('translator')->get('labels.Are you sure you want to cancel this order?'); ?>")) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }


    $("#registration").on('click', '#submit', function (event) {

        var param = $("#parameter").val();
        var select = $("#FilterBy").val();

        if ((select == null) || (param == "")) {
            $("#contact-form12").text("fill the credentials!").css({'color': 'red'}).show().fadeOut(10000);
            $("#parameter").css({'border-color': 'red'});
            $("select").css({'border-color': 'red'});
            event.preventDefault();
        } else {
            // $( "#contact-form12" ).text( "fill the credentials!" ).css({'padding-left':'10px','margin-right':'20px','padding-bottom':'2px', 'color':'red'}).show().fadeOut( 10000 );
            //     event.preventDefault();
        }
    });


    Dropzone.options.myDropzone = {
        paramName: 'file',
        maxFilesize: 5, // MB
        maxFiles: 20,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            this.on("success", function (file, response) {
                var a = document.createElement('span');
                // a.className = "thumb-url btn btn-primary";
                a.setAttribute('data-clipboard-text', '<?php echo e(url('admin/media/uploadimage')); ?>' + '/' + response);
                // a.innerHTML = "copy url";
                file.previewTemplate.appendChild(a);


            });

            this.on("success", function () {
                $("#compelete").removeAttr("disabled");
                $("#compelete").click(function () {

                    location.reload()
                })
            });


        }
    };


    $('.thumb-url').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    function setTooltip(btn, message) {
        $(btn).tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function () {
            $(btn).tooltip('hide');
        }, 500);
    }

    var clipboard = new Clipboard('.thumb-url');

    clipboard.on('success', function (e) {
        e.clearSelection();
        setTooltip(e.trigger, 'Copied!');
        hideTooltip(e.trigger);

    });


    clipboard.on('error', function (e) {
        e.clearSelection();
        setTooltip(e.trigger, 'Failed');
        hideTooltip(e.trigger);
    });

    $(document).ready(function () {
        $("#myModaldetail").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $.get("<?php echo e(URL::to('admin/detailimage')); ?>" + '/' + id, function (data) {
                $(".image_embed").html(data);
            });

        });
    });

    function ConfirmDelete() {
        var Delete = confirm("Are you sure you want to delete?");
        if (Delete)
            return true;
        else
            return false;
    }

    $("select.show-html").imagepicker();
    $("#AddImage").click(function () {
        window.location.href = '<?php echo e(url("admin/media/addimages")); ?>';
    });

    $(document).on('click', '#selected', function () {
        var image_src = $('.thumbnail.selected').children('img').attr('src');
        $('#selectedthumbnail').html('<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
        $('#selectedthumbnail').show();
        $('#image-close').show();
        $('#imageselected').removeClass('has-error');
        $('#newImage').removeClass('field-validate');
        $('.thumbnail.selected').removeClass('selected');
    });

    // $(document).on('click', '.testSelected', function () {
    //     $('.thumbnail.selected').removeClass('selected');
    //     $("#select_img option:selected").each(function () {
    //         var $this = $(this);
    //         if ($this.length) {
    //             var image_src = $this.data('img-src');;
    //             console.log(image_src);
    //             $('#selectedthumbnail').html( $('#selectedthumbnail').html( )+'<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
    //             $('#selectedthumbnail').show();
    //             $('#image-close').show();
    //             $('#imageselected').removeClass('has-error');
    //             $('#newImage').removeClass('field-validate');
    //
    //         }
    //     });
    //     //
    //
    //
    // });

    $(document).on('click', '#image-close', function () {
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked: function () {
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
        $('#selectedthumbnail').hide();
        $('#image-close').hide();
        $('#imageselected').removeClass('has-error');
    });

    $(document).on('click', '#closemodal', function () {
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked: function () {
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
    });

    $(document).on('click', '#selectedICONE', function () {
        var image_src = $('.thumbnail.selected').children('img').attr('src');
        $('#selectedthumbnailIcon').html('<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px; ">');
        $('#selectedthumbnailIcon').show();
        $('#image-Icone').show();
        $('#imageIcone').removeClass('has-error');
        $('#newIcon').removeClass('field-validate');
    });


    //show modal
    $(document).on('click', '.add-image', function () {
        var parent_id = $(this).parents('.image-content').attr('id');
        $('#' + parent_id + ' #imagemodel').modal('show');
    });


    //select image from modal
    $(document).on('click', '.selected-image', function () {
        var parent_id = $(this).parents('.image-content').attr('id');
        var image_src = $('#' + parent_id + ' .thumbnail.selected').children('img').attr('src');
        $('#' + parent_id + ' .selectedthumbnail').html('<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px; ">');

        $('#' + parent_id + '.selectedthumbnail').show();
        $('#' + parent_id + '#show-image-btn').show();
        $('#' + parent_id).removeClass('has-error');
        $('#' + parent_id).removeClass('field-validate');

        //$('#'+parent_id).children('#imagemodel').modal('show');

        //neareas('#imagemodel').modal('show');
        //alert(parent_id);
        // var image_src = $('.thumbnail.selected').children('img').attr('src');
        // $('#selectedthumbnailIcon').html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px; ">');
        // $('#selectedthumbnailIcon').show();
        // $('#image-Icone').show();
        // $('#imageIcone').removeClass('has-error');
        // $('#newIcon').removeClass('field-validate');
    });

    $(document).on('click', '#image-Icone', function () {
        $("select.show-html.iconimg:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked: function () {
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
        $('#selectedthumbnailIcon').hide();
        $('#image-Icone').hide();
        $('#imageIcone').removeClass('has-error');
    });


    var idCount = 1;
    $('.products_left_banner').each(function () {
        // $(this).attr('id', 'left_banner_selected' + idCount);
        var selectid = '#left_banner_selected' + idCount;

        var selectedthumbnail = '#selectedthumbnail' + idCount;
        var imageright = '#newImageleft' + idCount;
        // alert(selectid);
        var imageclose = '#image-close' + idCount
        $(document).on('click', selectid, function () {
            var image_src = $('.thumbnail.selected').children('img').attr('src');
            $(selectedthumbnail).html('<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
            $(selectedthumbnail).show();
            $(imageclose).show();
            $('#imageselected').removeClass('has-error');
            $(imageright).removeClass('field-validate');
            $('.thumbnail.selected').removeClass('selected');

        });

        $(document).on('click', imageclose, function () {
            $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
                // show_label:   true,
                clicked: function () {
                    $(this).find("option[value='" + $(this).val() + "']").empty();
                }
            });
            $(selectedthumbnail).hide();
            $(imageclose).hide();
            $('#imageselected').removeClass('has-error');
        });

        $(document).on('click', '#closemodal', function () {
            $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
                // show_label:   true,
                clicked: function () {
                    $(this).find("option[value='" + $(this).val() + "']").empty();
                }
            });
        });
        idCount++;

    });

    var idCount = 1;
    $('.products_right_banner').each(function () {
        // $(this).attr('id', 'left_banner_selected' + idCount);
        var selectid = '#right_banner_selected' + idCount;
        var selectedthumbnail = '#selectedthumbnail_right_banner' + idCount;
        // alert(selectid);
        var imageclose = '#image-close_right_banner' + idCount
        var imageright = '#newImageright' + idCount
        $(document).on('click', selectid, function () {
            var image_src = $('.thumbnail.selected').children('img').attr('src');
            $(selectedthumbnail).html('<img src="' + image_src + '" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
            $(selectedthumbnail).show();
            $(imageclose).show();
            $('#imageselected').removeClass('has-error');
            $(imageright).removeClass('field-validate');
            $('.thumbnail.selected').removeClass('selected');

        });

        $(document).on('click', imageclose, function () {
            $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
                // show_label:   true,
                clicked: function () {
                    $(this).find("option[value='" + $(this).val() + "']").empty();
                }
            });
            $(selectedthumbnail).hide();
            $(imageclose).hide();
            $('#imageselected').removeClass('has-error');
        });

        $(document).on('click', '#closemodal', function () {
            $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
                // show_label:   true,
                clicked: function () {
                    $(this).find("option[value='" + $(this).val() + "']").empty();
                }
            });
        });
        idCount++;
    });

    //ajax call for submit value
    $(document).on('click', '.refresh-image', function (e) {
        $("#loader").show();
        $.ajax({
            url: '<?php echo e(URL::to("admin/media/refresh")); ?>',
            type: "GET",
            success: function (res) {

                if (res.length != '') {
                    $('.show-html').html(res);
                } else {
                    $('.addError').show();
                }
                $("select.show-html").imagepicker();
            },
        });
    });

    $(document).on('click', '.price_included_tax', function (e) {
        var val = $(this).val();
        if (val == 'yes') {
            $('.form-group-tax').show();
        } else {
            $('.form-group-tax').hide();
        }
    });

    //ajax call for confirm passowrd match
    $(document).on('click', '#password-confirm-btn', function (e) {
        $("#checkpassword").modal('show');
    });

    $(document).on('click', '#check-password', function (e) {
        var password = $("#password").val();
        if (password != '') {
            $.ajax({
                url: '<?php echo e(URL::to("admin/managements/checkpassword")); ?>',
                type: "post",
                data: '&password=' + password,
                success: function (res) {

                    if (res == 1) {
                        //submit form of updater
                        $("#checkpassword").modal('hide');
                        $("#updater-form").submit();
                    } else {
                        //$("#passowrd-error").show();
                        //setTimeout(function(){ $("#passowrd-error").hide(); }, 3000);
                    }
                },
            });
        } else {
            $("#passowrd-error").show();
            setTimeout(function () {
                $("#passowrd-error").hide();
            }, 3000);
        }
    });


    //editAddressModal


    $(document).on('click', '.replay_btn', function () {
        $('#replayModal').modal('show');
        $("#ques_ques_replay_id").val(0);
        $("#question_reply").val('');
    });


    $(document).on('click', '.btn_update_replay', function () {
        $('#replayModal').modal('show');
        var id = $(this).data('id');
        var old = $('#replay_text_' + id).text();
        $("#ques_ques_replay_id").val(id)
        $("#question_reply").val(old);
    });


    $(document).on('click', '.btn_delete_replay', function () {

        if (confirm('هل تريد حذف هذا الاستفسار') == true) {
            var id = $(this).data('id');
            var data = '_token=' + encodeURIComponent("<?php echo e(csrf_token()); ?>")
                + '&reply_id=' + id;
            $.ajax({
                type: 'POST',
                url: '<?php echo e(URL::to("admin/product_questions/delete_replay")); ?>', //Returns ID in body
                data: data,
                // async: false, // <<== THAT makes us wait until the server is done.
                success: function (data) {
                    if (data == 1)
                        $('#replay_dev_' + id).remove();
                    else
                        alert(('حدث خطاء ماء اثناء الحذف'))
                },
                error: function (jqXhr, status) {
                    console.log(jqXhr);
                    // alert("Your error message goes here");
                }
            });
        }

    });


    $(document).on('click', '#btnSendReply', function (e) {
            var ques_ques_id = $('#ques_ques_id').val();
            var question_reply = $('#question_reply').val();
            var ques_ques_replay_id = $('#ques_ques_replay_id').val();
            var describtion = $('#question_reply').val();
            var describtion = describtion.replace(/\s+/g, '');
            if (describtion == '')
                alert('يجب الرد على السؤوال');
            else {
                var data = '_token=' + encodeURIComponent("<?php echo e(csrf_token()); ?>")
                    + '&ques_ques_id=' + ques_ques_id
                    + '&ques_ques_replay_id=' + ques_ques_replay_id
                    + '&reply=' + question_reply;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(URL::to("admin/product_questions/replay")); ?>', //Returns ID in body
                    data: data,
                    // async: false, // <<== THAT makes us wait until the server is done.
                    success: function (data) {
                        $('#ReplyText' + ques_ques_id).text(question_reply);
                        $('#replayModal').modal('hide');
                        if (ques_ques_replay_id == 0)
                            location.reload();
                        else
                            $('#replay_text_' + ques_ques_replay_id).text(question_reply);
                    },
                    error: function (jqXhr, status) {
                        console.log(jqXhr);
                        // alert("Your error message goes here");
                    }
                });
            }
        }
    );
    $(document).on('change', '#view_categories_content', function () {
        if ($(this).val() == 'products') {
            $('#div_categories_view_categories').hide();
            $('#div_products_view_categories').show();
        } else {
            $('#div_categories_view_categories').show();
            $('#div_products_view_categories').hide();
        }

        $("#question_reply").val('');
    });
    product_n = 1;
    $(document).on('click', '#btn_add_bouquets_products', function (e) {

        e.preventDefault();
        // alert('d');
        var quantity = $("#products_count").val();
        var product_text = $("#select_product_id  option:selected").text();
        var products_id = $("#select_product_id").val();

if(products_id>0 && quantity>0 )
        {
            var map = {};
            var temptext = "";
            var tempInputes = "";
            $('input[name^="attributeid"]').each(function () {
                map[$(this).attr('attributeid')] = $(this).attr('attribute_name');

                var id = ($(this).attr('attributeid'));
                var name = ($(this).attr('attribute_name'));
                var option_name = $('input[name^="values_' + id + '"]:checked').data('name');
                var option_id = $('input[name^="values_' + id + '"]:checked').val();
                temptext += name + " ( " + option_name + ") , ";
                tempInputes += "<input type=\"hidden\" name=\"products[" + product_n + "][options][" + id + "][option_id]\" value='" + id + "'>";
                tempInputes += "<input type=\"hidden\" name=\"products[" + product_n + "][options][" + id + "][attribute_id]\" value='" + option_id + "'>";
            });
            console.log(map);
            add_row_address(products_id, product_text, quantity, tempInputes, temptext);
        }
    });
    function add_row_address(products_id, product_text, quantity, product_options, options) {
        var data = " <tr id=\"product_n_" + product_n + "\">\n" +
            "            <td> <input type=\"hidden\" name=\"products[" + product_n + "][products_id]\" value='" + products_id + "'>" + product_text + "" +
            " <div class=\"print-error-msg alert-danger\"id=\"modal_error_products." + product_n + ".zone\"></div></td>\n" +
            "            <td width='10%'> <input type=\"number\" min=\"1\" name=\"products[" + product_n + "][quantity]\" value='" + quantity + "'>" +
            " <div class=\"print-error-msg alert-danger\"id=\"modal_error_products." + product_n + ".zone\"></div></td>\n" +
            "            <td width='50%'> " + options +product_options+ "</div>\n </td>\n" +
            "            <td>  <button onclick=\"deleteOneProduct(" + product_n + ")\"><i class=\"fa fa-trash\"></i></button></td>\n" +
            "            </tr>";
        $('#products_list_table').append(data);
        product_n++;

    }

    function deleteOneProduct(id) {
        $("#product_n_" + id).remove();
    }

</script>




<?php /**PATH F:\sites\mysan\resources\views/admin/common/scripts.blade.php ENDPATH**/ ?>