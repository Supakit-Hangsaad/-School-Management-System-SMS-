<?php
/**
 * @filesource modules/school/views/importgrade.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace School\Importgrade;

use \Kotchasan\Http\Request;
use \Kotchasan\Html;
use \Kotchasan\Language;
use \Kotchasan\Http\UploadedFile;
use \Gcms\Login;

/**
 * module=school-import&type=grade
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{

  /**
   * ฟอร์มนำเข้าผลการเรียน
   *
   * @param Request $request
   * @param array $login
   * @return string
   */
  public function render(Request $request, $login)
  {
    if (Login::checkPermission($login, 'can_manage_course')) {
      // สามารถจัดการรายวิชาทั้งหมดได้
      $can_manage_course = 0;
    } else {
      // ไม่สามารถจัดการรายวิชาทั้งหมดได้ แสดงเฉพาะรายการของตัวเอง
      $can_manage_course = $login['id'];
    }
    // form
    $form = Html::create('form', array(
        'id' => 'setup_frm',
        'class' => 'setup_frm',
        'autocomplete' => 'off',
        'action' => 'index.php/school/model/import/submit',
        'onsubmit' => 'doFormSubmit',
        'ajax' => true,
        'token' => true
    ));
    $fieldset = $form->add('fieldset', array(
      'title' => '{LNG_Import} {LNG_Grade}'
    ));
    $groups = $fieldset->add('groups');
    // course
    $groups->add('select', array(
      'id' => 'course',
      'labelClass' => 'g-input icon-elearning',
      'itemClass' => 'width50',
      'label' => '{LNG_Course}',
      'options' => \School\Course\Model::init($can_manage_course)->toSelect(),
      'value' => $request->request('course')->topic()
    ));
    // room
    $groups->add('select', array(
      'id' => 'room',
      'labelClass' => 'g-input icon-group',
      'itemClass' => 'width50',
      'label' => '{LNG_Room}',
      'options' => \Index\Category\Model::init('room')->toSelect(),
      'value' => $request->request('room')->toInt()
    ));
    $groups = $fieldset->add('groups');
    // year
    $groups->add('text', array(
      'id' => 'year',
      'labelClass' => 'g-input icon-calendar',
      'itemClass' => 'width50',
      'label' => '{LNG_Academic year}',
      'title' => '{LNG_Please fill in} {LNG_Academic year}',
      'maxlength' => 4,
      'pattern' => '[0-9]+',
      'required' => true,
      'value' => $request->request('year', self::$cfg->academic_year)->toInt()
    ));
    // term
    $groups->add('select', array(
      'id' => 'term',
      'labelClass' => 'g-input icon-category',
      'itemClass' => 'width50',
      'label' => '{LNG_Term}',
      'options' => Language::get('SCHOOL_TERMS'),
      'value' => $request->request('term', self::$cfg->term)->toInt()
    ));
    // import
    $fieldset->add('file', array(
      'id' => 'import',
      'labelClass' => 'g-input icon-excel',
      'itemClass' => 'item',
      'label' => '{LNG_Browse file}',
      'comment' => Language::replace('File size is less than :size', array(':size' => UploadedFile::getUploadSize())),
      'accept' => array('csv')
    ));
    $file = 'modules/school/views/importgrade_'.Language::name().'.html';
    if (!is_file(ROOT_PATH.$file)) {
      $file = 'modules/school/views/importgrade_th.html';
    }
    $fieldset->add('aside', array(
      'class' => 'message',
      'innerHTML' => file_get_contents(ROOT_PATH.$file)
    ));
    $fieldset = $form->add('fieldset', array(
      'class' => 'submit'
    ));
    // submit
    $fieldset->add('submit', array(
      'class' => 'button save large',
      'value' => '{LNG_Import}'
    ));
    // type
    $fieldset->add('hidden', array(
      'id' => 'type',
      'value' => 'grade'
    ));
    // Javascript
    $form->script('initSchoolImportgrade();');
    // คืนค่า HTML Form
    return $form->render();
  }
}