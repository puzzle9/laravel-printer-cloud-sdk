<?php

namespace Puzzle9\PrinterCloudSdk\Service;

use Illuminate\Support\Facades\Http;
use Puzzle9\PrinterCloudSdk\Exceptions\ErrorParam;
use Puzzle9\PrinterCloudSdk\Exceptions\ErrorResponse;

/**
 * @url http://www.feieyun.com/open/index.html
 */
class Feieyun implements Service
{
    private $config;
    
    private $url = 'https://api.feieyun.cn/Api/Open/';
    
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function request($apiname, $data)
    {
        $time = time();
        $config = $this->config;
        $user = $config['user'];
        
        $sig = sha1($user . $config['ukey'] . $time);
        
        $response = Http::asForm()->post($this->url, array_merge($data, [
            'user'    => $user,
            'stime'   => $time,
            'sig'     => $sig,
            'apiname' => $apiname,
        ]));
        
        $response_status = $response->status();
        if ($response_status != 200) {
            throw new ErrorResponse($response_status);
        }
        
        $data = $response->json();

        if ($data['ret']) {
            throw new ErrorParam($data['msg']);
        }
        
        return $data['data'];
    }
    
    public function printAdd($sn, $key, $remark = null, $phone = null)
    {
        $data = $this->request('Open_printerAddlist', [
            'printerContent' => implode('#', [
                $sn,
                $key,
                $remark,
                $phone,
            ]),
        ]);
        
        $no = $data['no'];
        
        if ($no) {
            throw new ErrorParam($no[0]);
        }
        
        return true;
    }
    
    public function printDel($sn)
    {
        $data = $this->request('Open_printerDelList', [
            'snlist' => $sn,
        ]);
        
        $no = $data['no'];
        
        if ($no) {
            throw new ErrorParam($no[0]);
        }
        
        return true;
    }
    
    public function printStatus($sn)
    {
        return $this->request('Open_queryPrinterStatus', [
            'sn' => $sn,
        ]);
    }
    
    public function printTxt($sn, $content, $data = [])
    {
        return $this->request('Open_printMsg', array_merge([
            $sn,
            $content,
        ], $data));
    }
    
    public function printCleanAll($sn)
    {
        return $this->request('Open_delPrinterSqs', [
            'sn' => $sn,
        ]);
    }
    
    public function orderStatus($order_id)
    {
        return $this->request('Open_queryOrderState', [
            'orderid' => $order_id,
        ]);
    }
}