<?php
/**
 * @filesource modules/school/views/course.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace School\Course;

use \Kotchasan\Http\Request;
use \Kotchasan\Html;
use \Kotchasan\Language;
use \Gcms\Login;
use \Kotchasan\ArrayTool;

/**
 * module=school-course
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{

  /**
   * ฟอร์ม เพิ่ม-แก้ไข ข้อมูลรายวิชา
   *
   * @param Request $request
   * @param array $course
   * @return string
   */
  public function render(Request $request, $course, $login)
  {
    // register form
    $form = Html::create('form', array(
        'id' => 'setup_frm',
        'class' => 'setup_frm',
        'action' => 'index.php/school/model/course/submit',
        'onsubmit' => 'doFormSubmit',
        'ajax' => true,
        'token' => true
    ));
    $fieldset = $form->add('fieldset', array(
      'title' => '{LNG_Details of} {LNG_Course}'
    ));
    $groups = $fieldset->add('groups');
    // course_code
    $groups->add('text', array(
      'id' => 'course_code',
      'labelClass' => 'g-input icon-number',
      'itemClass' => 'width50',
      'label' => '{LNG_Course Code}',
      'maxlength' => 20,
      'autofocus' => true,
      'value' => $course->course_code
    ));
    // course_name
    $groups->add('text', array(
      'id' => 'course_name',
      'labelClass' => 'g-input icon-elearning',
      'itemClass' => 'width50',
      'label' => '{LNG_Course Name}',
      'maxlength' => 50,
      'value' => $course->course_name
    ));
    $groups = $fieldset->add('groups');
    // credit
    $groups->add('text', array(
      'id' => 'credit',
      'labelClass' => 'g-input icon-number',
      'itemClass' => 'width50',
      'label' => '{LNG_Credit}',
      'pattern' => '[0-9\.]+',
      'value' => $course->credit
    ));
    // period
    $groups->add('text', array(
      'id' => 'period',
      'labelClass' => 'g-input icon-clock',
      'itemClass' => 'width50',
      'label' => '{LNG_Period}',
      'pattern' => '[0-9]+',
      'value' => $course->period
    ));
    $groups = $fieldset->add('groups');
    // type
    $groups->add('select', array(
      'id' => 'type',
      'labelClass' => 'g-input icon-category',
      'itemClass' => 'width50',
      'label' => '{LNG_Type}',
      'options' => Language::get('COURSE_TYPIES'),
      'value' => $course->type
    ));
    // class
    $groups->add('select', array(
      'id' => 'class',
      'labelClass' => 'g-input icon-office',
      'itemClass' => 'width50',
      'label' => '{LNG_Class}',
      'options' => \Index\Category\Model::init('class')->toSelect(),
      'value' => $course->class
    ));
    $groups = $fieldset->add('groups');
    // year
    $groups->add('text', array(
      'id' => 'year',
      'labelClass' => 'g-input icon-calendar',
      'itemClass' => 'width50',
      'label' => '{LNG_Academic year}',
      'maxlength' => 4,
      'pattern' => '[0-9]+',
      'value' => $course->year
    ));
    // term
    $groups->add('select', array(
      'id' => 'term',
      'labelClass' => 'g-input icon-category',
      'itemClass' => 'width50',
      'label' => '{LNG_Term}',
      'options' => Language::get('SCHOOL_TERMS'),
      'value' => $course->term
    ));
    // สามารถจัดการรายวิชาทั้งหมดได้
    if (Login::checkPermission($login, 'can_manage_course')) {
      // teacher_id
      $fieldset->add('select', array(
        'id' => 'teacher_id',
        'labelClass' => 'g-input icon-customer',
        'itemClass' => 'item',
        'label' => '{LNG_Teacher}',
        'options' => ArrayTool::merge(array(0 => '{LNG_please select}'), \School\Teacher\Model::init()->toSelect(0)),
        'value' => $course->teacher_id
      ));
    }
    $fieldset = $form->add('fieldset', array(
      'class' => 'submit'
    ));
    // submit
    $fieldset->add('submit', array(
      'class' => 'button save large',
      'value' => '{LNG_Save}'
    ));
    // id
    $fieldset->add('hidden', array(
      'id' => 'id',
      'value' => $course->id
    ));
    // Javascript
    $form->script('initSchoolCourse();');
    return $form->render();
  }
}
