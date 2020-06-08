<?php


namespace Validators;

use Models\Admin;

class FileValidator extends BaseValidator
{
    protected $_insert;
    public function __construct()
    {
        $this->_insert = new Admin();

    }

    public function validateFile($filename)
    {
        if (array_get($_FILES, $filename) == "") {
             $this->addErrors('file_require', 'File không tồn tại');
        }
        if (array_get($_FILES[$filename], 'name') == "") {
             $this->addErrors('file_require', 'File không tồn tại');
        }
        if (array_get($_FILES[$filename], 'size') > 10048576){
             $this->addErrors('file_require', 'File không Hợp lệ');
        }
        if (empty(array_get($_FILES[$filename], 'error')) == false){
             $this->addErrors('file_require', 'File không Hợp lệ');
        }
        $file_name = array_get($_FILES[$filename], 'name');
        $file_ext =explode('.',$file_name);
        $file_ext=end($file_ext);
        $file_ext=strtolower($file_ext);
        $file_tmp = array_get($_FILES[$filename], 'tmp_name');
        if ($file_ext != "csv"){
            $this->addErrors('file_require', 'File không Hợp lệ');
        }else{
            move_uploaded_file($file_tmp,"Config/".$file_name);
            $this->validateContentFile($file_name);
        }
        return $this->isValid();
    }

    public function validateContentFile($file_name)
    {
        $file_name = "Config/$file_name";
        $file = fopen($file_name, "r");
        while (!feof($file)) {
            $csv[] = fgetcsv($file);

        }

        $count = count($csv);
        $arr = [];
        $this->_insert->startTransaction();
        for ($row = 1; $row < $count; $row++) {
            if (!isset($csv[$row][0]) || $csv[$row][0] == "") {
                $line = $row+1;
                $this->addErrors('name_require'.$line, "Name ko chính xác ở dòng số" . $line);
            }
            if (!isset($csv[$row][1]) || $csv[$row][1] == "") {
                $line = $row+1;
                $this->addErrors('password_require'.$line, "pasword ko chính xác ở dòng số" . $line);
            }
            $arr[$csv[0][0]] = isset($csv[$row][0]) ? $csv[$row][0] : null;
            $arr[$csv[0][1]] = isset($csv[$row][1]) ? $csv[$row][1] : null;
            try {
                $this->_insert->insert($arr);

            } catch (\Exception $exception) {
                $this->_insert->rollBack();
                echo $exception->getMessage();
            }
        }
        if (!$this->isValid()){
            var_dump($this->getErrors());
            return $this->isValid();
        }
        $this->_insert->commit();
        $this->addErrors('success','Thêm mới thành công');
        return $this->isValid();

    }
}