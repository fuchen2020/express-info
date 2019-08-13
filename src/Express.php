<?php

/**
 * Created by PhpStorm.
 * author: _Dust_
 * Date: 2019-08-13
 * Time: 15:14
 */
namespace Fuchen2020\ExpressInfo;

use Fuchen2020\ExpressInfo\Exceptions\HttpException;
use GuzzleHttp\Client;

class Express
{
    protected $key; //客户授权key
    protected $customer; //查询公司编号
    protected $guzzleOptions = [];


    public function __construct(string $key,string $customer)
    {
        $this->key = $key;
        $this->customer = $customer;
    }

    /**
     * 创建请求客户端
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * 组装请求参数项
     * @param array $options
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * 获取快递轨迹信息
     * @param string $expressCode 快递公司编码
     * @param string $expressNo 快递单号
     * @param string $phone 寄件人或收件人手机号(顺丰单号必填)
     * @param string $format 返回格式
     * @return mixed|string
     * @throws HttpException
     */
    public function getExpressInfo(string $expressCode, string $expressNo,string $phone = '',string $format = 'json')
    {

        $url = 'http://poll.kuaidi100.com/poll/query.do';

        $param = json_encode([
            'com' =>$expressCode,			//快递公司编码
            'num' => $expressNo,	        //快递单号
            'phone' => $phone,				//手机号
            'from' => '',				    //出发地城市
            'to' => '',					    //目的地城市
            'resultv2' => '1'			    //开启行政区域解析
        ]);

         $query= array_filter([
            'customer'=>$this->customer,
            'sign' => strtoupper(md5($param.$this->key.$this->customer)),
            'param' => $param
        ]);

        try{

            $response = $this->getHttpClient()->post($url, [
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' === $format ? \json_decode($response, true) : $response;

        }catch (\Exception $exception){
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }

    }
}