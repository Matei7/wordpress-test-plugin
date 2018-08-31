jQuery(document).ready(function ($) {
    $('.color-picker').wpColorPicker();

    $heightSlider = $("#line-slider");
    $spacingSlider = $("#spacing-slider");

    $height = $("#line-height");
    $spacing = $("#letter-spacing");


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

    $minHeight = $heightSlider.slider("option", "min");
    $maxHeight = $heightSlider.slider("option", "max");
    $minSpacing = $spacingSlider.slider("option", "min");
    $maxSpacing = $spacingSlider.slider("option", "max");

    $('#min-height').text($minHeight);
    $('#min-spacing').text($minSpacing);
    $('#max-height').text($maxHeight);
    $('#max-spacing').text($maxSpacing);


    $height.change(function () {
        $value = $(this).val();
        $heightSlider.slider("value", $value);
        if ($value > $maxHeight) {
            $height.val($maxHeight);
        } else if ($value < $minHeight) {
            $height.val($minHeight);
        }
    });
    $spacing.change(function () {
        $value = $(this).val();
        $spacingSlider.slider("value", $value);
        if ($value > $maxSpacing) {
            $spacing.val($maxSpacing);
        } else if ($value < $minSpacing) {
            $spacing.val($minSpacing);
        }
    });
});