<?php
/**
 * 文件上传
 * 
 * 
 * 
 * 
 * Tools
 * 
 * 
 */
class XUpload {

    /**
     * 单个文件上传
     *
     * @param $fileFields
     * @param $thumb
     * @param $thumbSize
     * @param $allowExts
     * @param $maxSize
     * @param $savePath
     * @return unknown
     */
    private function _saveRule( $params = array( 'rule'=>'default', 'format'=>'Ymd' ) ) {
        $path = '';
        switch ( $params['rule'] ) {
        case 'custom':
            $path .= $params['string'] . '/';
            break;
        case 'user':
            isset( $params['userPath'] ) && $path .= $params['userPath'] . '/';
            isset( $params['userId'] ) && $path .= $params['userId'] . '/';
            isset( $params['format'] ) && $path .= date( $params['format'] ) . '/';
            break;
        default:
            $paths = isset( $params['format'] ) ? date( $params['format'] ) . '/' : date( 'Ym' ) . '/';
            $path .= $paths;
            break;
        }
        return 'uploads/' . $path;
    }

    /**
     * 单个文件上传
     *
     * @param [type]  $fileFields [description]
     * @return [type]             [description]
     */
    static public function upload( $fileFields, $params = array( 'thumb'=>false, 'thumbSize' => array( 400, 400 ), 'allowExts' => 'jpg,gif,png,jpeg', 'maxSize' => 3292200 ) ) {
        Yii::import( 'application.vendors.*' );
        require_once 'Tp/UploadFile.class.php';
        $upload = new UploadFile();
        // 设置上传文件大小
        $upload->maxSize = isset( $params['maxSize'] ) ? $params['maxSize']: Config::get( 'maxSize' );
        // 设置上传文件类型
        $upload->allowExts = isset( $params['allowExts'] )? explode( ',', $params['allowExts'] ):  explode( ',', Config::get( 'upload_allow_ext' ) );
        // 设置附件上传目录
        $upload->savePath = self::_saveRule( $params['saveRule'] );
        // 设置需要生成缩略图，仅对图像文件有效
        $upload->thumb =  isset( $params['thumb'] ) ? $params['thumb']: Config::get( 'thumb' );
        // 设置需要生成缩略图的文件后缀
        $upload->thumbPrefix = 'thumb_'; // 生产2张缩略图
        // 设置缩略图最大宽度
        $upload->thumbMaxWidth = $params['thumbSize'][0];
        // 设置缩略图最大高度
        $upload->thumbMaxHeight = $params['thumbSize'][1];
        // 设置上传文件规则
        $upload->saveRule = uniqid;
        // 删除原图
        $upload->thumbRemoveOrigin = false;
        $file = $upload->uploadOne( $fileFields );

        if ( ! is_array( $file ) ) {
            return $upload->getErrorMsg();
        } else {
            // 重新整理返回数据
            $fileget['name'] = $file[0]['name'];
            $fileget['type'] = $file[0]['type'];
            $fileget['size'] = $file[0]['size'];
            $fileget['extension'] = $file[0]['extension'];
            $fileget['savepath'] = $file[0]['savepath'];
            $fileget['savename'] = $file[0]['savename'];
            $fileget['hash'] = $file[0]['hash'];
            $fileget['pathname'] = '/'.$upload->savePath . $file[0]['savename'];
            if ( Config::get( 'upload_water_status' ) == 'open' ) {
                require_once 'Tp/Image.class.php';
                Image::water( $fileget['pathname'], './'.Config::get( 'upload_water_file' ), null, Config::get( 'upload_water_trans' ) );
            }
            // 缩略图返回
            if ( true == $upload->thumb ) {
                $fileget['thumb'] = $upload->thumbPrefix . $file[0]['savename'];
                $fileget['paththumbname'] = '/'.$upload->savePath . $upload->thumbPrefix . $file[0]['savename'];
            }
            self::uploadToQiniu($file[0]['savepath']. $file[0]['savename'],$upload->savePath . $file[0]['savename']);

            return $fileget;
        }

    }

    /**
     * 多文件上传
     *
     * @param boolean $thumb [description]
     * @return [type]         [description]
     */
    static public function uploads( $thumb = true, $params = array( 'thumb'=>false, 'thumbSize' => array( 400, 400 ), 'allowExts' => 'jpg,gif,png,jpeg', 'maxSize' => 3292200 ) ) {
        Yii::import( 'application.vendors.*' );
        require_once 'Tp/UploadFile.class.php';
        // 设置上传文件大小
        $upload->maxSize = isset( $params['maxSize'] ) ? $params['maxSize']: Config::get( 'maxSize' );
        // 设置上传文件类型
        $upload->allowExts = isset( $params['allowExts'] )? explode( ',', $params['allowExts'] ):  explode( ',', Config::get( 'upload_allow_ext' ) );
        // 设置附件上传目录
        $upload->savePath = self::_saveRule( $params );
        // 设置需要生成缩略图，仅对图像文件有效
        $upload->thumb = isset( $params['thumb'] ) ? $params['thumb']: Config::get( 'thumb' );
        // 设置需要生成缩略图的文件后缀
        $upload->thumbPrefix = 'thumb_'; // 生产2张缩略图
        // 设置缩略图最大宽度
        $upload->thumbMaxWidth = $params['thumbSize'][0];
        // 设置缩略图最大高度
        $upload->thumbMaxHeight = $params['thumbSize'][1];
        // 设置上传文件规则
        $upload->saveRule = uniqid;
        // 删除原图
        $upload->thumbRemoveOrigin = false;

        if ( ! $upload->upload() ) {
            return $upload->getErrorMsg();
        } else {
            $fileinfo = $upload->getUploadFileInfo();
            require_once 'Tp/Image.class.php';
            Image::water( $fileget['pathname'], './'.Config::get( 'upload_water_file' ), null, Config::get( 'upload_water_trans' ) );
            foreach ( $fileinfo as $key => $row ) {
                if ( true == $upload->thumb )
                    $fileinfo[$key]['thumb'] = $upload->thumbPrefix . $fileinfo[$key]['savename'];
                $fileinfo[$key]['pathname'] = '/'.$upload->savePath . $fileinfo[$key]['savename'];
                $fileinfo[$key]['paththumbname'] = '/'.$upload->savePath . $upload->thumbPrefix . $fileinfo[$key]['savename'];

                self::uploadToQiniu($fileinfo[$key]['savepath']. $fileinfo[$key]['savename'],$upload->savePath . $fileinfo[$key]['savename']);
                if ( Config::get( 'upload_water_status' ) == 'open' )
                    Image::water( $fileinfo[$key]['pathname'], './'.Config::get( 'upload_water_file' ), null, Config::get( 'upload_water_trans' ) );
            }
            return $fileinfo;
        }
    }
    /*
    上传到七牛云平台
    */
    static public function uploadToQiniu($file_path,$file_name){
        //if(YII_ENV=='production'){
            Yii::import( 'application.vendors.Qiniu.*');
            require_once 'Qiniu.php';
            $client = \Qiniu\Qiniu::create(array(
                'access_key' => Yii::app()->params['qiniu']['access_key'],
                'secret_key' => Yii::app()->params['qiniu']['secret_key'],
                'bucket'     => Yii::app()->params['qiniu']['bucket'],
            ));
            $res = $client->uploadFile($file_path, $file_name);

        //}
    }
}
