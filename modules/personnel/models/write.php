<?php
/**
 * @filesource modules/personnel/models/write.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Personnel\Write;

use \Kotchasan\Http\Request;
use \Kotchasan\Language;
use \Gcms\Login;
use \Kotchasan\File;

/**
 * เพิ่ม/แก้ไข ข้อมูลบุคลากร
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{

  /**
   * บันทึกข้อมูลที่ส่งมาจากฟอร์ม write.php
   *
   * @param Request $request
   */
  public function submit(Request $request)
  {
    $ret = array();
    // session, token, สมาชิก
    if ($request->initSession() && $request->isSafe() && $login = Login::isMember()) {
      // ตรวจสอบค่าที่ส่งมา
      $index = \Personnel\User\Model::getForWrite($request->post('personnel_id')->toInt());
      if (!$index) {
        // ไม่พบรายการที่แก้ไข
        $ret['alert'] = Language::get('Sorry, Item not found It&#39;s may be deleted');
      } else {
        // ครู-อาจารย์, สามารถจัดการนักเรียนได้
        if (!Login::checkPermission($login, 'can_manage_personnel')) {
          // ตัวเอง
          $login = $login['id'] == $index->id ? $login : false;
        }
        if ($login && $login['active'] == 1) {
          // ค่าที่ส่งมา
          $user = array(
            'name' => $request->post('personnel_name')->topic(),
            'phone' => $request->post('personnel_phone')->topic(),
            'birthday' => $request->post('personnel_birthday')->date(),
          );
          $personnel = array(
            'id_card' => $request->post('personnel_id_card')->number(),
            'order' => $request->post('personnel_order')->toInt(),
          );
          $urls = array();
          foreach (Language::get('PERSONNEL_CATEGORY') as $key => $label) {
            $personnel[$key] = $request->post('personnel_'.$key)->toInt();
            $urls[$key] = $personnel[$key];
          }
          // custom item
          foreach (Language::find('PERSONNEL_DETAILS', array()) as $key => $label) {
            $personnel['custom'][$key] = $request->post('personnel_'.$key)->topic();
          }

          if (!$index) {
            // ไม่พบรายการที่แก้ไข
            $ret['alert'] = Language::get('Sorry, Item not found It&#39;s may be deleted');
          } elseif ($user['name'] == '') {
            // ไม่ได้กรอก name
            $ret['ret_personnel_name'] = 'Please fill in';
          } elseif (\Personnel\User\Model::exists($index->id, $personnel)) {
            // เลขประชาชนซ้ำ
            $ret['ret_personnel_id_card'] = Language::replace('This :name already exist', array(':name' => Language::get('Identification number')));
          } else {
            if ($index->id == 0) {
              // ใหม่ บันทึก user
              if ($personnel['id_card'] != '' && $user['birthday'] != '') {
                $user['username'] = $personnel['id_card'];
                $user['password'] = preg_replace('/[^0-9]+/', '', $user['birthday']);
              }
              // สถานะครู
              $user['status'] = isset(self::$cfg->teacher_status) ? self::$cfg->teacher_status : 0;
              // register
              $user = \Index\Register\Model::execute($this, $user);
              // id ของบุคลากร
              $personnel['id'] = $user['id'];
            } else {
              // id ของบุคลากรจาก DB
              $personnel['id'] = $index->id;
            }
            // อัปโหลดรูปภาพพร้อมปรับขนาด
            foreach ($request->getUploadedFiles() as $item => $file) {
              /* @var $file UploadedFile */
              if ($file->hasUploadFile()) {
                if (!File::makeDirectory(ROOT_PATH.DATA_FOLDER.'personnel/')) {
                  // ไดเรคทอรี่ไม่สามารถสร้างได้
                  $ret['ret_'.$item] = sprintf(Language::get('Directory %s cannot be created or is read-only.'), DATA_FOLDER.'personnel/');
                } elseif (!$file->validFileExt(array('jpg', 'jpeg', 'png'))) {
                  // ชนิดของไฟล์ไม่ถูกต้อง
                  $ret['ret_'.$item] = Language::get('The type of file is invalid');
                } elseif ($item == 'personnel_picture') {
                  $picture = DATA_FOLDER.'personnel/'.$personnel['id'].'.'.$file->getClientFileExt();
                  try {
                    $file->cropImage(array('jpg', 'jpeg', 'png'), ROOT_PATH.$picture, self::$cfg->personnel_w, self::$cfg->personnel_h);
                  } catch (\Exception $exc) {
                    // ไม่สามารถอัปโหลดได้
                    $ret['ret_'.$item] = Language::get($exc->getMessage());
                  }
                }
              } elseif ($file->hasError()) {
                // upload Error
                $ret['ret_'.$item] = $file->getErrorMessage();
              }
            }
            if (empty($ret)) {
              $personnel['custom'] = empty($personnel['custom']) ? '' : serialize($personnel['custom']);
              if ($index->id > 0) {
                if (isset($picture)) {
                  $user['picture'] = $picture;
                }
                // update user
                $this->db()->update($this->getTableName('user'), $index->id, $user);
                // update personnel
                $this->db()->update($this->getTableName('personnel'), $index->id, $personnel);
              } else {
                if (isset($picture)) {
                  // update user picture
                  $this->db()->update($this->getTableName('user'), $personnel['id'], array('picture' => $picture));
                }
                // insert personnel
                $this->db()->insertOrUpdate($this->getTableName('personnel'), $personnel);
              }
              // ส่งค่ากลับ
              if ($index->id == 0) {
                // แสดงรายการใหม่
                $urls['sort'] = 'id desc';
                $urls['page'] = 1;
              } else {
                $urls = array();
              }
              $urls['module'] = 'personnel-setup';
              $urls['id'] = 0;
              $ret['location'] = $request->getUri()->postBack('index.php', $urls);
              $ret['alert'] = Language::get('Saved successfully');
            }
          }
        }
      }
    }
    if (empty($ret)) {
      $ret['alert'] = Language::get('Unable to complete the transaction');
    }
    // คืนค่าเป็น JSON
    echo json_encode($ret);
  }
}
