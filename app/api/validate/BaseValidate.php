<?php


namespace app\api\validate;


use app\api\libs\exceptions\ParameterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck() {
        $params = Request::param();

        $checkRes = $this->check($params);
        if (!$checkRes) {
            throw new ParameterException([
                'msg' => $this->error
            ]);
        }
        return true;
    }

    protected function isNotEmpty($value, $rule, $field, $data=[]) {
        return empty($value) ? $field . '不能为空' : true;
    }
}