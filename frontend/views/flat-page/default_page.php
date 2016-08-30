<?php
use yii\helpers\Html;
use common\helpers\Translate;
use common\models\FlatPage;

$this->params['breadcrumbs'][] = $flatPage->anchor;

?>

<h1><?php echo $flatPage->anchor; ?></h1>

<?= Translate::t($flatPage->url, 'main-content') ?>