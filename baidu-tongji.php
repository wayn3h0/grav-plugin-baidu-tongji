<?php
namespace Grav\Plugin;
use Grav\Common\Plugin;
class BaiduTongjiPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onAssetsInitialized' => ['onAssetsInitialized', 0]
        ];
    }
    /**
     * Add tracking code
     */
    public function onAssetsInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }
        $trackingID = trim($this->config->get('plugins.baidu-tongji.trackingID'));
        if ($trackingID) {
            $init = "
            <script>
              var _hmt = _hmt || [];
              (function() {
              var hm = document.createElement('script');
              hm.src = '//hm.baidu.com/hm.js?{$trackingID}';
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(hm, s);
              })();
            </script>
            ";
            $this->grav['assets']->addInlineJs($init);
        }
    }
}
