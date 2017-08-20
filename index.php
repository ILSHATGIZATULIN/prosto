

<?php
/*
* T_ML_COMMENT не существует в PHP 5.
* Следующие три строчки определяют его для
* сохранения обратной совместимости.
*
* Следующие две строчки определяют T_DOC_COMMENT только для PHP 5,
* который мы маскируем как T_ML_COMMENT для PHP 4.
*/
if (!defined('T_ML_COMMENT')) {
    define('T_ML_COMMENT', T_COMMENT);
} else {
    define('T_DOC_COMMENT', T_ML_COMMENT);
}

$source = file_get_contents('example.php');
$tokens = token_get_all($source);

foreach ($tokens as $token) {
    if (is_string($token)) {
        // простая 1-буквенная лексема
        echo $token;
    } else {
        // токен-массив
        list($id, $text) = $token;

        switch ($id) {
            case T_COMMENT:
            case T_ML_COMMENT: // мы определили это
            case T_DOC_COMMENT: // и это
                // нет действий для комментариев
                break;

            default:
                // все остальное -> выводим "как есть"
                echo $text;
                break;
        }
    }
}
?>