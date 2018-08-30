jQuery(document).ready(function ($) {
        $('#submit').click(function (e) {
            e.preventDefault();
            console.log('A');
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {
                    'action': 'input_picker',
                    'line_height': $("#line-height").val(),
                    'spacing': $("#letter-spacing").val(),
                    'color': $("#color").val(),

                },
                success: function (data) {
                    console.log(data);
                    $("#color").val("#bada55");
                    $("#line-height").val('');
                    $("#letter-spacing").val('');
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
            return false;
        })
});