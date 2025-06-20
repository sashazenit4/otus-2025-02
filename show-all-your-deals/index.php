<?php
require_once (__DIR__.'/crest_ext.php');
CRest_Ext::setCurrentBitrix24($_REQUEST['member_id']);
$result = CRest_Ext::call('crm.deal.list');
var_dump($result);

?>
<ul>
<?php
foreach ($result as $deal) { ?>
    <li><?=$deal['TITLE']?></li>
<?php
}
?>
</ul>
