<?php

namespace src\Controller\View\und;

use libs\Html\HtmlTag;
use libs\Html\HtmlTagTable;

require_once 'libs/Html/HtmlTagTable.php';

$title = new HtmlTag('h2', 'Unidades');
$content = array(
    array(
        'nome'=>'José Hélio',
        'sobrenome'=>'Verissimo Jr',
        'idade'=>46
    )
);
$table = new HtmlTagTable('table', $content);