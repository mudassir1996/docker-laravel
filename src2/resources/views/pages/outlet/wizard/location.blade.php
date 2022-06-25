<script>
    $('.btn-next').click(() => {
        var outlet_title = $('#outlet_title').val();
        var outlet_phone = $('#outlet_phone').val();

        $('#outlet_title').val(outlet_title.trim());
        $('#outlet_phone').val(outlet_phone.trim());
    });
    // let old_state = {{ old('outlet_state') }}

    // $("#city").append('<option value="' + value + '">' + key + '</option>');
    // $("#city").append('<option value="' + value + '">' + key + '</option>');
    $(document).ready(function() {
        old_state = "{{ old('outlet_state') }}";
        old_city = "{{ old('outlet_city') }}";
        var selected = '';

        var countryID = $('#country').val();

        if (countryID) {
            $.ajax({
                url: "{{ url('get-state') }}?country_id=" + countryID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option value="">Select state</option>');
                        $("#state").selectpicker("refresh");
                        $("#state").selectpicker("val", ['']);

                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + value + '">' + key +
                                '</option>');
                            $("#state").selectpicker("refresh");
                            if (old_state == value) {
                                $("#state").selectpicker("val", [value]);
                            }

                        });

                    } else {
                        $("#state").empty();
                        $("#state").append('<option value="">Select country first</option>');
                        $("#state").selectpicker("refresh");
                        $("#state").selectpicker("val", ['']);

                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);
                    }
                }
            });
        } else {
            $("#state").empty();
            $("#state").append('<option value="">Select country first</option>');
            $("#state").selectpicker("refresh");
            $("#state").selectpicker("val", ['']);

            $("#city").empty();
            $("#city").append('<option value="">Select state first</option>');
            $("#city").selectpicker("refresh");
            $("#city").selectpicker("val", ['']);
        }

        var stateID = old_state;
        if (stateID) {
            $.ajax({
                url: "{{ url('get-city') }}?state_id=" + stateID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $("#city").append('<option value="">Select city</option>');
                        $.each(res, function(key, value) {

                            $("#city").append('<option value="' + value + '">' + key +
                                '</option>');
                            $("#city").selectpicker("refresh");
                            if (old_city == value) {
                                $("#city").selectpicker("val", [value]);
                            }

                        });
                    } else {
                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);
                    }
                }
            });
        } else {
            $("#city").empty();
            $("#city").append('<option value="">Select state first</option>');
            $("#city").selectpicker("refresh");
            $("#city").selectpicker("val", ['']);
        }
    });

    $('#country').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            console.log(countryID);
            $.ajax({
                url: "{{ url('get-state') }}?country_id=" + countryID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option value="">Select state</option>');
                        $("#state").selectpicker("refresh");
                        $("#state").selectpicker("val", ['']);

                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);

                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + value + '">' + key +
                                '</option>');
                            $("#state").selectpicker("refresh");
                            // if(old_state==value){
                            //     $("#state").selectpicker("val", [value]);
                            // }

                        });

                    } else {
                        $("#state").empty();
                        $("#state").append('<option value="">Select country first</option>');
                        $("#state").selectpicker("refresh");
                        $("#state").selectpicker("val", ['']);

                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);


                    }
                }
            });
        } else {
            $("#state").empty();
            $("#state").append('<option value="">Select country first</option>');
            $("#state").selectpicker("refresh");
            $("#state").selectpicker("val", ['']);

            $("#city").empty();
            $("#city").append('<option value="">Select state first</option>');
            $("#city").selectpicker("refresh");
            $("#city").selectpicker("val", ['']);
        }
    });
    $('#state').change(function() {
        var stateID = $(this).val();
        if (stateID) {
            $.ajax({
                url: "{{ url('get-city') }}?state_id=" + stateID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $("#city").append('<option value="">Select city</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);
                        $.each(res, function(key, value) {
                            $("#city").append('<option value="' + value + '">' + key +
                                '</option>');
                            $("#city").selectpicker("refresh");
                        });

                    } else {
                        $("#city").empty();
                        $("#city").append('<option value="">Select state first</option>');
                        $("#city").selectpicker("refresh");
                        $("#city").selectpicker("val", ['']);
                    }
                }
            });
        } else {
            $("#city").empty();
            $("#city").append('<option value="">Select state first</option>');
            $("#city").selectpicker("refresh");
            $("#city").selectpicker("val", ['']);
        }
    });
</script>
