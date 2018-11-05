<?php
/**
 * Created by PhpStorm.
 * User: alinec
 * Date: 2018/11/2
 * Time: 下午6:16
 */
namespace Home\Model;
use Think\Model;

/**
 * 分类模型
 */
class TrackModel extends Model {
    public function setBj($id) {
        $trackInfo = $this->where([
            'uid' => $id
        ])->find();


        if($trackInfo) {
            $this->where([
                'uid' => $id
            ])->save([
                'contact' => $trackInfo['contact'] + 1
            ]);
        } else {
            $this->add([
                'uid' => $id,
                'contact' => '1',
                'trackName' => '小王'
            ]);
        }

        echo 1;

    }

    public function setValid($id, $valid) {
        $trackInfo = $this->where([
            'uid' => $id
        ])->find();


        if($trackInfo) {
            $this->where([
                'uid' => $id
            ])->save([
                'isValid' => $valid
            ]);
        } else {
            $this->add([
                'uid' => $id,
                'contact' => '1',
                'isValid' => $valid,
                'trackName' => '小王'
            ]);
        }

        echo 1;
    }

    public function addRemake($id, $remake) {
        $trackInfo = $this->where([
            'uid' => $id
        ])->find();


        if($trackInfo) {
            $this->where([
                'uid' => $id
            ])->save([
                'remake' => $remake
            ]);
        } else {
            $this->add([
                'uid' => $id,
                'contact' => '1',
                'remake' => $remake,
                'trackName' => '小王'
            ]);
        }

        echo 1;
    }
}