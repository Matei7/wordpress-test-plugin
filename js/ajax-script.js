jQuery(document).ready(function ($) {

        function getCurrentValues() {
            $.ajax({
                type: "post",
                url: my_ajax_object.ajax_url,
                data: {
                    'action': 'getCurrentValues',
                },
                success: function (data) {
                    console.log(data);
                    var values = $.parseJSON(data);
                    $div = $("#current-values");
                    for (var key in values) {
                        $p = $('<p>');
                        $p.html(key + " has value " + values[key]);
                        $div.append($p);
                    }
                }
            });
        }

        getCurrentValues();
        $('#submit').click(function (e) {
            e.preventDefault();
            console.log(my_ajax_object.ajax_url);
            $.ajax({
                type: "post",

                url: my_ajax_object.ajax_url,
                data: {
                    'action': 'input_picker',
                    'line_height': $("#line-height").val(),
                    'spacing': $("#letter-spacing").val(),
                    'color': $("#color").val(),

                },
                success: function (data) {
                    $("#line-height").val('');
                    $("#letter-spacing").val('');


                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
            return false;
        })
    }
);