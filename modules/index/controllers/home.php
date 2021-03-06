<?php
/**
 * @filesource modules/index/controllers/home.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Index\Home;

use \Kotchasan\Http\Request;
use \Kotchasan\Html;
use \Kotchasan\Language;
use \Gcms\Login;
use \Kotchasan\Collection;

/**
 * module=home
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{

  /**
   * Dashboard
   *
   * @param Request $request
   * @return string
   */
  public function render(Request $request)
  {
    // ข้อความ title bar
    $this->title = Language::get('Dashboard');
    // เลือกเมนู
    $this->menu = 'home';
    // แสดงผล
    $section = Html::create('section');
    // breadcrumbs
    $breadcrumbs = $section->add('div', array(
      'class' => 'breadcrumbs'
    ));
    $ul = $breadcrumbs->add('ul');
    $ul->appendChild('<li><span class="icon-home">{LNG_Home}</span></li>');
    $section->add('header', array(
      'innerHTML' => '<h2 class="icon-dashboard">'.$this->title.'</h2>'
    ));
    // Login
    $login = Login::isMember();
    // card
    $card = new Collection;
    // โหลด Component หน้า Home
    $dir = ROOT_PATH.'modules/';
    $f = @opendir($dir);
    if ($f) {
      while (false !== ($text = readdir($f))) {
        if ($text != '.' && $text != '..' && $text != 'index' && $text != 'css' && $text != 'js' && is_dir($dir.$text)) {
          if (is_file($dir.$text.'/controllers/home.php')) {
            require_once $dir.$text.'/controllers/home.php';
            $className = '\\'.ucfirst($text).'\Home\Controller';
            if (method_exists($className, 'addCard')) {
              $className::addCard($request, $card, $login);
            }
          }
        }
      }
      closedir($f);
    }
    // render card
    $dashboard = $section->add('div', array(
      'class' => 'dashboard'
    ));
    $ggrid = $dashboard->add('div', array(
      'class' => 'ggrid row'
    ));
    foreach ($card as $k => $item) {
      $ggrid->add('section', array(
        'class' => 'card block3 float-left',
        'innerHTML' => $item
      ));
    }
    return $section->render();
  }

  /**
   * ฟังก์ชั่นสร้าง card ในหน้า Home
   *
   * @param Collection $card
   * @param string $icon
   * @param string $title
   * @param int $value
   * @param string $link
   * @param string $url
   */
  public static function renderCard($card, $icon, $title, $value, $link, $url)
  {
    $content = '<a class="table fullwidth" href="'.$url.'">';
    $content .= '<span class="td '.$icon.' notext"></span>';
    $content .= '<span class="td right">';
    $content .= '<span class="cuttext">{LNG_'.$title.'}</span>';
    $content .= '<b>'.number_format($value).'</b>';
    $content .= '<span class="cuttext">{LNG_'.$link.'}</span>';
    $content .= '</span>';
    $content .= '</a>';
    $card->set($icon, $content);
  }
}
