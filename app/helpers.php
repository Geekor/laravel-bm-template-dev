<?php

/**
 * @Util 多语言
 * @desc 获取多语言翻译
 * @param $name string 多语言
 * @param ...$params any 多语言参数
 * @return string 多语言翻译
 * @example
 * // 返回 消息
 * L('Message');
 * // 返回 文件最大为10M
 * L('File Size Limit %s','10M');
 */
function L($name, ...$params)
{
    // static $sessionLocale = null;
    // static $locale = null;
    // static $fallbackLocale;
    // static $langTrans = [];
    // static $trackMissing = false;
    // static $trackMissingData = null;
    // if (null === $locale) {
    //     $sessionLocale = \Illuminate\Support\Facades\Session::get('_locale', null);
    //     $locale = config('app.locale');
    //     $fallbackLocale = config('app.fallback_locale');
    //     $trackMissing = config('modstart.lang.track_missing', false);
    //     if (ModuleManager::isModuleInstalled('I18n') && \ModStart\Core\Dao\ModelManageUtil::hasTable('lang_trans')) {
    //         $langTrans = \Module\I18n\Util\LangTransUtil::map();
    //     }
    // }
    // if ($trackMissing && null === $trackMissingData) {
    //     $trackMissingData = [];
    //     if (file_exists($file = storage_path('cache/lang_missing.php'))) {
    //         $trackMissingData = (require $file);
    //     }
    //     register_shutdown_function(function () use (&$trackMissingData, $file) {
    //         ksort($trackMissingData);
    //         file_put_contents($file, '<?php return ' . var_export($trackMissingData, true) . ';');
    //     });
    // }
    // if ($sessionLocale && isset($langTrans[$sessionLocale][$name])) {
    //     if ($trackMissing && isset($trackMissingData[$name])) unset($trackMissingData[$name]);
    //     if (!empty($params)) {
    //         return call_user_func_array('sprintf', array_merge([$langTrans[$sessionLocale][$name]], $params));
    //     }
    //     return $langTrans[$sessionLocale][$name];
    // } else if (isset($langTrans[$locale][$name])) {
    //     if ($trackMissing && isset($trackMissingData[$name])) unset($trackMissingData[$name]);
    //     if (!empty($params)) {
    //         return call_user_func_array('sprintf', array_merge([$langTrans[$locale][$name]], $params));
    //     }
    //     return $langTrans[$locale][$name];
    // } else if (isset($langTrans[$fallbackLocale][$name])) {
    //     if ($trackMissing && isset($trackMissingData[$name])) unset($trackMissingData[$name]);
    //     if (!empty($params)) {
    //         return call_user_func_array('sprintf', array_merge([$langTrans[$fallbackLocale][$name]], $params));
    //     }
    //     return $langTrans[$fallbackLocale][$name];
    // }
    // foreach (['base.' . $name, 'modstart::base.' . $name] as $id) {
    //     $trans = trans($id);
    //     if ($trans !== $id) {
    //         if ($trackMissing && isset($trackMissingData[$name])) unset($trackMissingData[$name]);
    //         if (!empty($params)) {
    //             return call_user_func_array('sprintf', array_merge([$trans], $params));
    //         }
    //         return $trans;
    //     }
    // }
    // if ($trackMissing) $trackMissingData[$name] = $name;
    // if (!empty($params)) {
    //     return call_user_func_array('sprintf', array_merge([$name], $params));
    // }
    return $name;
}
