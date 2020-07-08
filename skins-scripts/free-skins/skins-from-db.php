<?php
session_start();

$images = [
	"https://knify.fr/wp-content/uploads/Butterfly-Slaughter-6.jpg",
	"https://crystal-castle.ru/wa-data/public/shop/products/34/20/2034/images/4896/4896.970.jpg",
	"https://ostrovrusa.ru/wp-content/uploads/2019/09/blobid1568367726699.jpg",
	"https://lh3.googleusercontent.com/proxy/M2EbVuujWtSMnq-omLD4wNKeqdGxnSf6yUCYdp82Hek5PFlYl97BZ4r2jTMBuBLeC8q8QFmFjTCUvsxBBfkT",
	"https://ho8ssabqvb.a.trbcdn.net/wp-content/uploads/2019/04/ohotnichiy-nozh-ks-go.jpg",
	"https://1hp.tv/content/images/2019/09/kerambit-avtotronika.jpg",
	"https://blog.cs.money/wp-content/uploads/2019/08/photo_2019-08-07_00-57-22-1024x569.jpg",
	"https://sun9-7.userapi.com/c824700/v824700796/17251b/4gC78OFTU0w.jpg",
	"https://blog.cs.money/wp-content/uploads/2019/08/photo_2019-08-07_01-05-23.jpg",
	"https://img-fotki.yandex.ru/get/232848/11206178.b9e/0_12829d_12f26d35_orig",
	"https://blog.cs.money/wp-content/uploads/2019/08/33248961_1525391044257039_6119439141001232384_n.jpg",
	"https://portamur.ru/upload/iblock/202/Clipboard10.jpg",
	"https://i.pinimg.com/originals/57/43/d1/5743d1a6d04454817aff4b27d73018b0.png",
	"https://i.pinimg.com/originals/84/1a/b0/841ab0d894c00f24075719c13a274559.png",
	"https://pelu.ru/public/screenshot77383683.jpg",
	"https://ho8ssabqvb.a.trbcdn.net/wp-content/uploads/2019/04/ohotnichiy-nozh-ks-go.jpg",
	"https://psd-box.ru/wp-content/uploads/2019/03/34854466.jpg",
	"https://cdn.csgo.com/item_470033831_188530139.png",
	"https://xn--80aqhfdfbaipr3n.xn--p1ai/images/products/product_var_img_1708.jpg",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT4lQBYxafBxhm8VmC2sB6YHuD0L18esBmheHGeY6_n0zNHbW--",
	"https://cutefreaks.ru/upload/iblock/c65/c6539669cddd2e94e54e3935e55961d8.jpg",
	"https://cdn.csgo.com/item_1815702120_188530139.png",
	"https://cdn.csgo.com/item_310781313_0.png",
	"https://cs2play.ru/wp-content/uploads/2019/05/65543.jpg",
	"https://monateka.com/images/808158.jpg",
	"https://gocsgo.net/wp-content/uploads/2019/03/bez-imeni-1.jpg",
	"https://avatars.mds.yandex.net/get-zen_doc/1899873/pub_5d143a30ff8b5a00b16e4d9c_5d143adf6f100900afa3670e/scale_1200",
	"https://lh3.googleusercontent.com/proxy/2hlONN1DH6WXQyOeHCDaoRDoraA3J6sENgRlPq3Pg1o4BQ31aiP5tFvy91OkfxGGBGofVEn2_-68LlO74bIwp126zOrtcFyoWBx7GM8",
	"https://pelu.ru/public/screenshot77383683.jpg",
	"https://cs4.pikabu.ru/post_img/big/2016/07/23/0/1469224162149452700.jpg",
	"https://pro-men.ru/wp-content/uploads/2018/05/cb8bassmallwaz.jpg",
	"https://gocsgo.net/wp-content/uploads/2019/05/deagle-main.jpg",
	"https://gocsgo.net/wp-content/uploads/2019/05/kod-krasnyy-6000.jpg",
	"https://gocsgo.net/wp-content/uploads/2019/05/krovavaya-pautina-10000.jpg.pagespeed.ce.6ScxKFCT0l.jpg",
	"https://lh3.googleusercontent.com/proxy/CLdIk59GbQRcq2Yq3Nt-xIvbPqQZzMtfPusGnOnYBxxJsLIoeO8Vkx0OnGR4hJY_2hFTQw9Md0rs-xSHaJauG6sJwYBBvspb0kQlVfeX",
	"https://gocsgo.net/wp-content/uploads/2019/05/pischal-2000.jpg",
	"https://avatars.mds.yandex.net/get-zen_doc/111343/pub_5d7a22448600e100add9085c_5d7a25ae2f1e4400ad0a674e/scale_1200",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSdSl2ebW7U8feE0TqP9wNcaHexiaKHDGHoiW9c8aXjHZ_xkLeb",

];

if (isset($_POST["token"], $_SESSION["skinsTokenCsrf"]) && $_POST["token"] == $_SESSION["skinsTokenCsrf"]) {

	if (isset($_POST["skinsCount"]) && $_POST["skinsCount"] == true) {
		$data = ["imagesCount" => count($images)];
		echo json_encode($data);
		exit;
	};

	$text = "Все скины загружены! Желаем удачи! Чтобы получить скин, напишите комментарий под записью, какой именно скин из списка Вы хотели бы получить бесплатно и его номер. Спасибо.";

	$data = ["text" => $text, "images" => $images];

	echo json_encode($data);
	exit;
};
exit;