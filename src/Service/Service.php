<?php

namespace Puzzle9\PrinterCloudSdk\Service;

interface Service
{
    /**
     * 添加打印机
     * @param string $sn 打印机编号
     * @param string $key 打印机密钥
     * @param null $remark 备注
     * @param null $phone 流量卡号码
     * @return mixed
     */
    public function printAdd($sn, $key, $remark = null, $phone = null);
    
    /**
     * 删除打印机
     * @param string $sn 打印机编号
     * @return mixed
     */
    public function printDel($sn);
    
    /**
     * 打印机状态
     * @param string $sn 打印机编号
     * @return mixed
     */
    public function printStatus($sn);
    
    /**
     * 打印文本
     * @param string $sn 打印机编号
     * @param string $content 打印内容
     * @param array $data 其他信息
     * @return mixed
     */
    public function printTxt($sn, $content, $data = []);
    
    /**
     * 清空待打印队列
     * @param string $sn 打印机编号
     * @return mixed
     */
    public function printCleanAll($sn);
    
    /**
     * 查询订单状态
     * @param string $order_id 订单id
     * @return mixed
     */
    public function orderStatus($order_id);
}