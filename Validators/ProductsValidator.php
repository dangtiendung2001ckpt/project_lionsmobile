<?php


namespace Validators;


class ProductsValidator extends BaseValidator
{
    public function validateProducts($params){
        if (array_get($params, 'name') == ''){
            $this->addErrors('name_require','Bạn chưa nhập tên sản phẩm');
        }
        if (array_get($params, 'category') == ''){
            $this->addErrors('category_require','bạn cần chọn hãng');
        }
        if (array_get($params, 'sl') == ''){
            $this->addErrors('sl_require','bạn chưa nhập số lượng');
        }
        if (array_get($params, 'color') == ''){
            $this->addErrors('color_require','bạn chưa nhập màu sắc');
        }
        if (array_get($params, 'data') == ''){
            $this->addErrors('data_require','bạn chưa nhập data');
        }
        if (array_get($params, 'ram') == ''){
            $this->addErrors('ram_require','bạn chưa nhập dung lượng');
        }
        if (array_get($params, 'price') == ''){
            $this->addErrors('price_require','bạn chưa nhập giá');
        }
        if (array_get($params, 'manhinh') == ''){
            $this->addErrors('man_hinh_require','bạn chưa nhập màn hình');
        }
        if (array_get($params, 'hdh') == ''){
            $this->addErrors('he_dieu_hanh_require','bạn chưa nhập hẹ điều hành');
        }
        if (array_get($params, 'cpu') == ''){
            $this->addErrors('cpu_require','bạn chưa nhập cpu');
        }
        if (array_get($params, 'pin') == ''){
            $this->addErrors('pin_require','bạn chưa nhập pin');
        }
        if (array_get($params, 'phukien') == ''){
            $this->addErrors('phu_kien_require','bạn chưa nhập màn hình');
        }
        if (array_get($params, 'cameratruoc') == ''){
            $this->addErrors('cam_sau_require','bạn chưa nhập cammera truoc');
        }
        if (array_get($params, 'camerasau') == ''){
            $this->addErrors('cam_sau_require','bạn chưa nhập camera truoc');
        }
        return $this->isValid();


    }
}