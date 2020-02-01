<?php
namespace Application\Framework;

class Renderer
{
    public function html(Controller $_controller, $_tplPath)
    {
        if (is_array($_controller->scope) && count($_controller->scope) > 0) {
            extract($_controller->scope, EXTR_PREFIX_SAME, '');
        }

        $req = $_controller->getServiceLocator()->getRequest();
        $content = '';

        $tpl = __DIR__ . '/../tpl/' . $_tplPath . '.php';

        if (file_exists($tpl)) {
            try {
                ob_start();
                include($tpl);
                $content = ob_get_clean();
            } catch (\Exception $e) {
                echo '<p class="exception">' . $e->getMessage() . '</p>';
            }
        } else {
            $errMsg = 'No such view: ' . $tpl;
            throw new \Excpetion($errMsg);
        }

        $layout = __DIR__ . '/../tpl/layout.php';
        include($layout);
    }
}
