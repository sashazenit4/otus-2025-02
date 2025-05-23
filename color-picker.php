<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Color Picker');
CJSCore::init(['color_picker']);
?>

<div id="color-picker">Диалог выбора цвета</div>
<script>
    let cpContainer = BX('color-picker');
    cpContainer.onclick = function () {
        colorPicker.open();
    };
    var colorPicker = new BX.ColorPicker({
        bindElement: cpContainer,
    });
    colorPicker.open();
</script>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
