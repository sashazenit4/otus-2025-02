<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/telephony/editivr.php");

$APPLICATION->SetTitle(GetMessage("VI_PAGE_EDIT_IVR_TITLE_2"));
?>

<?$APPLICATION->IncludeComponent("bitrix:ui.sidepanel.wrapper",
	"",
	array(
		"POPUP_COMPONENT_NAME" => "bitrix:voximplant.ivr.edit",
		"POPUP_COMPONENT_TEMPLATE_NAME" => "",
		"USE_PADDING" => false
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
