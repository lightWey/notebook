<?php
$str = <<<EF
{"datetime":"2019-05-24T16:12:41.468+08:00","env":"dev","log_type":"api","log_level":"NOTICE","app_name":"sqkb-api-v2","uri":"/v2/coupon/coupon/detail","status":1,"hn":"dev-api_v2-001-113-174","client_id":"","device_id":"","x_sqkb_trace_id":"ed98feb4-68c3-4791-b5ab-ec22b3b0b961","x_forwarded_for":"123.126.2.158, 127.0.0.1","remote_ip":"10.165.123.105","content":"{\"flag\":\"zw-1\",\"data\":{\"coupon_id\":195557,\"title\":\"奔腾x40改装件led阅读灯车内顶灯牌照灯泡流氓内饰灯室内灯倒车灯\",\"subtitle\":\"奔腾x40改装件led车内流氓阅读灯\",\"item_id\":564584799864,\"raw_price\":40,\"zk_price\":20,\"description\":\"\",\"pic\":\"https://img.alicdn.com/bao/uploaded/i2/1024957811/TB2Yqaao0fJ8KJjy0FeXXXKEXXa_!!1024957811.jpg\",\"post_free\":1,\"month_sales\":0,\"comm_count\":1,\"order_count\":0,\"taobao_cate_ids\":\"13000000000,26,50018708,50022764,50022803\",\"platform_id\":1,\"source_id\":79,\"ticket_id\":0,\"cate_id\":26,\"subcate_id\":20619,\"cate_id3\":20661,\"cate_id4\":0,\"shop_id\":3390002,\"brand_id\":2408453,\"status\":0,\"is_ignore\":0,\"improve\":0,\"is_recommend\":0,\"is_prior\":0,\"order_time\":0,\"product_type\":2,\"intv2\":0,\"__ut\":1557454329,\"video_url\":\"\",\"video_pic_url\":\"\",\"commission\":0,\"service_promise_ids\":\"\",\"delivery_begin_hours\":0,\"avg_commission_rate\":0,\"commission_rate\":0,\"commission_type\":0,\"apply_nums\":0,\"order_nums\":0,\"is_must_grab\":0,\"is_nine\":0,\"nine_order\":0,\"prepayment\":0,\"is_promotion\":0,\"coupon_is_ka\":0,\"coupon_is_del\":0,\"extend\":\"\",\"same_coupon_id\":0,\"price_score\":0,\"white_image\":\"\",\"activity_id\":\"\",\"coupon_url\":\"\",\"coupon_price\":0,\"start_fee\":0,\"ticket_status\":0,\"coupon_type\":0,\"url_type\":0,\"coupon_start_time\":0,\"coupon_end_time\":0,\"is_check\":0,\"open_type\":0,\"remain_num\":0,\"total_num\":0,\"ticket_source_id\":0,\"platform_shop_id\":105943080,\"seller_id\":1024957811,\"shop_name\":\"429车光4S店\",\"shop_url\":\"http://shop105943080.taobao.com\",\"shop_rank\":32,\"shop_score\":\"4.8#1|4.8#1|4.8#1\",\"shop_score_avg\":\"4.80\",\"shop_is_ka\":0,\"shop_is_del\":0,\"shop_logo\":\"https://img.alicdn.com/imgextra//3a/e2/TB1KqgYj3HqK1RjSZFPSuwwapXa.jpg\",\"tbcid\":\"\",\"shop_nick\":\"返利商城阿柱\",\"is_golden\":1,\"shop_type\":6,\"service_promise\":[]}}","message":"null"}
EF;

$a1 = json_decode($str, true);
$a1 = json_decode($a1['content'], true);

$str = <<<EF
{"datetime":"2019-05-24T16:12:41.478+08:00","env":"dev","log_type":"api","log_level":"NOTICE","app_name":"sqkb-api-v2","uri":"/v2/coupon/coupon/detail","status":1,"hn":"dev-api_v2-001-113-174","client_id":"","device_id":"","x_sqkb_trace_id":"ed98feb4-68c3-4791-b5ab-ec22b3b0b961","x_forwarded_for":"123.126.2.158, 127.0.0.1","remote_ip":"10.165.123.105","content":"{\"flag\":\"zw-2\",\"data\":{\"coupon_id\":195557,\"title\":\"奔腾x40改装件led阅读灯车内顶灯牌照灯泡流氓内饰灯室内灯倒车灯\",\"subtitle\":\"奔腾x40改装件led车内流氓阅读灯\",\"item_id\":564584799864,\"raw_price\":40,\"zk_price\":20,\"description\":\"\",\"pic\":\"https://img.alicdn.com/bao/uploaded/i2/1024957811/TB2Yqaao0fJ8KJjy0FeXXXKEXXa_!!1024957811.jpg\",\"post_free\":1,\"month_sales\":0,\"comm_count\":1,\"order_count\":0,\"taobao_cate_ids\":\"13000000000,26,50018708,50022764,50022803\",\"platform_id\":1,\"source_id\":79,\"ticket_id\":0,\"cate_id\":26,\"subcate_id\":20619,\"cate_id3\":20661,\"cate_id4\":0,\"shop_id\":3390002,\"brand_id\":2408453,\"status\":0,\"is_ignore\":0,\"improve\":0,\"is_recommend\":0,\"is_prior\":0,\"order_time\":0,\"product_type\":2,\"intv2\":0,\"mkt\":[{\"product_type\":1,\"description\":\"乌拉圭进口含髓牛骨粉 蛋白质比鲜肉高\",\"start_time\":1556553600,\"end_time\":1559111071},{\"product_type\":2,\"description\":\"乌拉圭进口含髓牛骨粉 蛋白质比鲜肉高\",\"start_time\":1556553600,\"end_time\":1559111071}],\"__ut\":1557454329,\"video_url\":\"\",\"video_pic_url\":\"\",\"commission\":0,\"service_promise_ids\":\"\",\"delivery_begin_hours\":0,\"avg_commission_rate\":0,\"commission_rate\":0,\"commission_type\":0,\"apply_nums\":0,\"order_nums\":0,\"is_must_grab\":0,\"is_nine\":0,\"nine_order\":0,\"prepayment\":0,\"is_promotion\":0,\"coupon_is_ka\":0,\"coupon_is_del\":0,\"extend\":\"\",\"same_coupon_id\":0,\"price_score\":0,\"white_image\":\"\",\"activity_id\":\"\",\"coupon_url\":\"\",\"coupon_price\":0,\"start_fee\":0,\"ticket_status\":0,\"coupon_type\":0,\"url_type\":0,\"coupon_start_time\":0,\"coupon_end_time\":0,\"is_check\":0,\"open_type\":0,\"remain_num\":0,\"total_num\":0,\"ticket_source_id\":0,\"platform_shop_id\":105943080,\"seller_id\":1024957811,\"shop_name\":\"429车光4S店\",\"shop_url\":\"http://shop105943080.taobao.com\",\"shop_rank\":32,\"shop_score\":\"4.8#1|4.8#1|4.8#1\",\"shop_score_avg\":\"4.80\",\"shop_is_ka\":0,\"shop_is_del\":0,\"shop_logo\":\"https://img.alicdn.com/imgextra//3a/e2/TB1KqgYj3HqK1RjSZFPSuwwapXa.jpg\",\"tbcid\":\"\",\"shop_nick\":\"返利商城阿柱\",\"is_golden\":1,\"shop_type\":6,\"service_promise\":[]}}","message":"null"}
EF;
$a2 = json_decode($str, true);
$a2 = json_decode($a2['content'], true);