<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qcloud\Cos\Client;
use itbdw\QiniuStorage\QiniuStorage;

class UploadController extends Controller
{
    /**
     * 默认上传，使用七牛云静态存储
     * images-1253193383
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_api(Request $request)
    {
        $disk_qiniu = QiniuStorage::disk('qiniu');
        $qn_config = config('filesystems.disks.qiniu');
        $time = date('Y/m/d-H:i:s-');
        $file = 'http://'.$qn_config['domain'].'/';
        $file_name = $disk_qiniu->put($time, $request->file);

        if ($file_name) {
            return response()->json([
                'message' => '上传成功!',
                'ObjectURL' => $file.$file_name
            ]);
        }
       /* $cosClient = new Client(array('region' => env('COS_REGION'),
            'credentials' => array(
                'appId' => env('COS_APPID'),
                'secretId' => env('COS_KEY'),
                'secretKey' => env('COS_SECRET'))));

        try {
            $result = $cosClient->putObject(array(
                'Bucket' => 'images-1253193383',
                'Key' => md5_file($request->file) . '.' . $request->file->extension(),
                'Body' => file_get_contents($request->file),
                'ServerSideEncryption' => 'AES256'));
            return response()->json([
                'message' => '上传成功!',
                'ObjectURL' => $result['ObjectURL']
            ]);
        } catch (\Exception $e) {
            echo "$e\n";
        }*/
    }
}
