<?php

/**
 * EmailManager may be used in the following ways:
 * <pre>
 *              $mail = Yii::app()->emailManager->createMail('signup/confirm',
 *                   array(
 *                       'User'=>'Vasia',
 *                       'Say'=>'Hello',
 *                   )
 *               )->send('malyshev.php@gmail.com', 'Sergey Malyshev');
 *
 *               $mail = Yii::app()->emailManager->createMail('signup/confirm',
 *                   array(
 *                       'User'=>'Vasia',
 *                       'Say'=>'Hello',
 *                   )
 *               )->send(array(
 *                   'malyshev.php@gmail.com',
 *                   'ku4er.prg@gmail.com'
 *               ));
 *
 *               $mail = Yii::app()->emailManager->createMail('signup/confirm',
 *                   array(
 *                       'User'=>'Vasia',
 *                       'Say'=>'Hello',
 *                   )
 *               )->send(array(
 *                   array('malyshev.php@gmail.com'),
 *                   array('ku4er.prg@gmail.com'),
 *               ));
 *
 *               $mail = Yii::app()->emailManager->createMail('signup/confirm',
 *                   array(
 *                       'User'=>'Vasia',
 *                       'Say'=>'Hello',
 *                   )
 *               )->send(array(
 *                   array('malyshev.php@gmail.com', 'Sergey Malyshev'),
 *                   array('ku4er.prg@gmail.com', 'Andrew Kucherenko'),
 *               ));
 * </pre>
 */

define('MAILER_VENDOR_BASE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PhpMailer' . DIRECTORY_SEPARATOR);

require_once MAILER_VENDOR_BASE_PATH . 'class.phpmailer.php';
require_once MAILER_VENDOR_BASE_PATH . 'class.pop3.php';
require_once MAILER_VENDOR_BASE_PATH . 'class.smtp.php';

class EmailManager extends CBaseController
{

    private $_mailer;
    public $behaviors = array(
    );
    public $debug;
    public $layout = 'email';

    public function __construct()
    {
        $this->_mailer = new PHPMailer(true);
        $this->attachBehaviors($this->behaviors);
    }

    public function __call($method, $params)
    {
        if (method_exists($this->_mailer, $method))
            return call_user_func_array(array($this->_mailer, $method), $params);

        return parent::__call($method, $params);
    }

    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this->_mailer, $setter))
            return $this->_mailer->$setter($value);
        else if (method_exists($this->_mailer, $name))
            return $this->_mailer->$name($value);
        else if (property_exists($this->_mailer, $name))
            return $this->_mailer->$name = $value;

        return parent::__set($name, $value);
    }

    public function __get($name)
    {
        if (property_exists($this->_mailer, $name))
            return $this->_mailer->$name;

        return parent::__get($name);
    }

    public function init()
    {
        
    }

    public function display()
    {
        echo $this->_mailer->Body;
        exit;
        return true;
    }

    public function send($address, $name = '')
    {

        if ($this->debug && ($support = $this->getSupportProvider())) {
            $this->bindAddress($support->email, $support->name);
        } else
            $this->bindAddress($address, $name);

        Yii::app()->controller->beginClip('PHPMailer');
        $result = $this->_mailer->Send();
        Yii::app()->controller->endClip();

        if ($result && !$this->IsError()) {
            $this->reset();
            return $result;
        }

        return $this->_mailer->ErrorInfo;
    }

    public function reset()
    {
        $this->_mailer->ClearAddresses();
        $this->_mailer->ClearCCs();
        $this->_mailer->ClearBCCs();
        $this->_mailer->ClearReplyTos();
        $this->_mailer->ClearAllRecipients();
        $this->_mailer->ClearAttachments();
    }

    public function bindAddress($address, $name = '')
    {
        if (is_array($address)) {
            while ($recipient = array_shift($address)) {
                if (is_array($recipient)) {
                    $n = '';
                    if (sizeof($recipient) > 1)
                        list($r, $n) = $recipient;
                    else
                        $r = array_shift($recipient);
                    $this->_mailer->AddAddress($r, $n);
                }
                else {
                    $this->_mailer->AddAddress($recipient);
                }
            }
        } else
            $this->_mailer->AddAddress($address, $name);
    }

    public function bindParams($data = array())
    {
        if (!is_array($data)) {
            return;
        }
        
        foreach ($data as $k => $v) {
            try {
                $this->$k = $v;
            } catch (Exception $e) {
                
            }
        }
    }

    /**
     *
     * @param string view file
     * @param array data to be extracted and made available to the view file
     * @param boolean whether the mail is HTML
     * @return object
     */
    public function createMail($view, $data = null, $isHTML = true)
    {
        $this->IsHTML($isHTML);

        $this->bindParams($data);


        $this->render($view, $data);
        return $this;
    }

    public function render($view, $data = null, $isHTML = true, $return = false)
    {
        if (($viewFile = $this->getViewFile($view)) !== false) {
            $altBody = substr($viewFile, 0, strlen($viewFile) - 4) . '.alt' . substr($viewFile, -4);

            if (!$return) {
                $this->Body = $this->renderFile($viewFile, $data, true);


                if (($layoutFile = $this->getLayoutFile($this->layout)) !== false) {
                    $this->_mailer->Body = $this->renderFile($layoutFile, array('content' => $this->_mailer->Body), true);
                }

                if (file_exists($altBody) && is_file($altBody)) {
                    $this->AltBody = strip_tags($this->renderFile($altBody, $data, true));
                }

                return true;
            } else if ($return && $isHTML) {
                return $this->renderFile($viewFile, $data, true);
            } else if ($return && !$isHTML) {
                if (file_exists($altBody) && is_file($altBody))
                    return $this->renderFile($viewFile, $data, true);
            }
        }

        throw new CException(Yii::t('yii', '{controller} cannot find the requested email view "{view}".', array('{controller}' => get_class($this), '{view}' => $view)));
    }

    public function getLayoutFile($layoutName)
    {
        if ($layoutName === false)
            return false;
        if (($theme = Yii::app()->getTheme()) !== null && ($layoutFile = $theme->getLayoutFile($this, $layoutName)) !== false)
            return $layoutFile;

        if (empty($layoutName)) {
            $module = $this->getModule();
            while ($module !== null) {
                if ($module->layout === false)
                    return false;
                if (!empty($module->layout))
                    break;
                $module = $module->getParentModule();
            }
            if ($module === null)
                $module = Yii::app();
            return $this->resolveViewFile($module->layout, $module->getLayoutPath(), $module->getViewPath());
        }
        else {
            if (($module = $this->getModule()) === null)
                $module = Yii::app();
            return $this->resolveViewFile($layoutName, $module->getLayoutPath(), $module->getViewPath());
        }
    }

    public function getViewPath()
    {
        if (($module = $this->getModule()) === null)
            $module = Yii::app();
        return $module->getViewPath() . '/' . $this->getId();
    }

    public function getViewFile($viewName)
    {

        if (($theme = Yii::app()->getTheme()) !== null && ($viewFile = $theme->getViewFile($this, $viewName)) !== false)
            return $viewFile;

        $module = $this->getModule();
        $basePath = $module ? $module->getViewPath() : Yii::app()->getViewPath();
        return $this->resolveViewFile($viewName, $this->getViewPath(), $basePath);
    }

    public function resolveViewFile($viewName, $viewPath, $basePath)
    {
        if (empty($viewName))
            return false;
        if (($renderer = Yii::app()->getViewRenderer()) !== null)
            $extension = $renderer->fileExtension;
        else
            $extension = '.php';
        if ($viewName[0] === '/')
            $viewFile = $basePath . $viewName;
        else if (strpos($viewName, '.'))
            $viewFile = Yii::getPathOfAlias($viewName);
        else
            $viewFile = $viewPath . DIRECTORY_SEPARATOR . $viewName;

        if (is_file($viewFile . $extension)) {
            return Yii::app()->findLocalizedFile($viewFile . $extension);
        } else if ($extension !== '.php' && is_file($viewFile . '.php')) {
            return Yii::app()->findLocalizedFile($viewFile . '.php');
        }

        return false;
    }

    public function getModule()
    {
        return Yii::app()->controller->module;
    }

    public function getId()
    {
        return 'emails';
    }

    public function getUniqueId()
    {
        return $this->getId();
    }

}
