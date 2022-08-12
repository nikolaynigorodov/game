<?php


namespace Classes;


use LogicException;

class RandomOrg
{
    protected string $apiKey = "ca1cd25b-2d7e-4e20-b4b1-ccdac72e5682";
    protected int $min;
    protected int $max;
    protected $randomValue;

    public function requestApi()
    {
        $parsedAry = [
            "jsonrpc" => "2.0",
            "method" => "generateIntegers",
            "params" => [
                "apiKey" => $this->apiKey,
                "n" => 1,
                "min" => $this->min,
                "max" => $this->max,
                "replacement" => true
            ],
            "id" => 3
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.random.org/json-rpc/1/invoke');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parsedAry));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $out = curl_exec($ch);
        curl_close($ch);
        $this->decodeResult($out);
        return $this;
    }

    public function decodeResult($json)
    {
        $decodeJson = json_decode($json, true);
        if(isset($decodeJson['result']['random']['data']['0'])){
            $this->randomValue = $decodeJson['result']['random']['data']['0'];
        } else {
            throw new LogicException("random.org does not work!!!");
        }
    }

    /**
     * @return mixed
     */
    public function getRandomValue()
    {
        return $this->randomValue;
    }

    /**
     * @param int $min
     * @return RandomOrg
     */
    public function setMin(int $min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param int $max
     * @return RandomOrg
     */
    public function setMax(int $max): self
    {
        $this->max = $max;
        return $this;
    }
}