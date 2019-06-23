<?php
$coupon['id'] = 123;
$coupon['mkt'] = [
      [
            "product_type"=> 1,
              "description"=> "乌拉圭进口含髓牛骨粉 蛋白质比鲜肉高",
              "start_time"=> 1556553600,
              "end_time"=> 1559111071
      ],
      [
            "product_type"=> 2,
              "description"=> "乌拉圭进口含髓牛骨粉 蛋白质比鲜肉高",
              "start_time"=> 1556553600,
              "end_time"=> 1559111071
      ]
];

$newMkt = null;

        if ($coupon['mkt']) {
            $now = time();

            $newMkts = array_filter($coupon['mkt'], function ($mkt) use ($now) {
                if ($mkt['end_time'] > $now && $mkt['product_type'] != 3) {
                    return true;
                }
            });

            if ($newMkts) {
                $newMkt              = isset($newMkts[1]) ? $newMkts[1] : $newMkts[2];
                $newMkt['left_time'] = $newMkt['end_time'] - $newMkt['start_time'];
                unset($newMkt['end_time']);
                unset($newMkt['start_time']);
            }
        }

        $coupon['mtk'] = $newMkt;

        print_r($coupon);