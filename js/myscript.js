jQuery(document).ready(function ($) {
    $('.color-picker').wpColorPicker();

    $heightSlider = $("#line-slider");
    $spacingSlider = $("#spacing-slider");

    $height = $("#line-height");
    $spacing = $("#letter-spacing");

    $height.change(function () {
        $heightSlider.slider("value", $(this).val());
    });
    $spacing.change(function () {
        $spacingSlider.slider("value", $(this).val());
    });

    $heightSlider.slider({
        range: "max",
        min: 0,
        max: 100,
        value: 50,
        slide: function (event, ui) {
            $height.val(ui.value);
        }
    });
    $spacingSlider.slider({
        range: "max",
        min: 0,
        max: 100,
        value: 50,
        slide: function (event, ui) {
            $spacing.val(ui.value);
        }
    });

    $('#min-height').text($heightSlider.slider("option", "min"));
    $('#min-spacing').text($spacingSlider.slider("option", "min"));
    $('#max-height').text($heightSlider.slider("option", "max"));
    $('#max-spacing').text($spacingSlider.slider("option", "max"));
});