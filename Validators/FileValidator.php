<?php


namespace Validators;


class FileValidator extends BaseValidator
{
    public function validateFile($filename)
    {
        if (array_get($_FILES, $filename) == "") {
            return $this->addErrors('file_require', 'File không tồn tại');
        }
        if (array_get($_FILES[$filename], 'name') == "") {
            return $this->addErrors('file_require', 'File không tồn tại');
        }
        if (array_get($_FILES[$filename], 'name') == ""){

        }
    }
}