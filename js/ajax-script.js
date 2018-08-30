jQuery(document).ready(function ($) {

        function getCurrentValues() {
            $.ajax({
                type: "post",
                dataType: 'json',
                url: my_ajax_object.ajax_url,
                data: {
                    'action': 'getCurrentValues',
                },
                success: function (data) {
                    $div = $("#current-values");
                    $div.empty();
                    for (var key in data) {
                        $p = $('<p>');
                        $p.html(key + " has value " + data[key]);
                        $div.append($p);
                    }
                }
            });
        }

        getCurrentValues();
        $('#submit').click(function (e) {
            e.preventDefault();

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
                    getCurrentValues();
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
            return false;
        })
    }
);