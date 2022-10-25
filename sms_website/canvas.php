<?php
// Set the content-type
header('Content-Type: image/png');

$im_width = 475;
$im_height = 680;
$des_x = 140;
$des_y = 160;
// define("im_width",478);
// echo constant("im_width");
// Create the image
$im = imagecreatetruecolor($im_width, $im_height);
$dest = imagecreatetruecolor($des_x, $des_y);
// Create some colors
$bgcolor = imagecolorallocate($im, 242, 242, 242);
$black = imagecolorallocate($im, 0, 0, 0);
$bordercolor = imagecolorallocate($im, 128, 128, 128);
$white = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
imagefilledrectangle($im, 0, 0, $im_width, $im_height, $white);

// The text to draw
$text = 'Rohit Kumar (My Public Notebook)';
// Replace path by your own font path
$font = 'C:/xampp/htdocs/sms_website/font/NotoSerif-Regular.ttf';
$src = ('C:/xampp/htdocs/sms_website/image/logo7.png');
$fontsize = 7;
// Add some shadow to the text
$im_x = 15;
$im_y = 220;
$box_width = 20;
$box_width2 = 30;
$box_y = 60;
$rowright = 50;
// // Add the text
// drawtext($im, 16, 16, 12, $black, $font, $text);
drawimg($im, 0, 0, 140, 136, 15, 50, $src);
// drawtext($im, 16, 32, 12, $black, $font, "Hello World");
////////////////////////////////////////////////// Top part/////////////////////////////
drawtext($im, 60, 30, "14", $black, $font, "CÔNG TY ABCD - PHIẾU LƯƠNG 8/2022");
////////////////////////////////////////////////// Top part/////////////////////////////
////////////////////////////////////////////////// Top right part///////////////////////
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Họ và tên");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "Luis Thomas");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "MSNV");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "202124");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Phòng ban");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "Sản xuất");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Hình thức chi lương");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "148583056");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright + 10, "$fontsize", $black, $font, "Vị trí");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "Tổ trưởng tổ BTP bàn ngồi & phụ kiện");
$rowright = $rowright + $box_width2 + 10;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Giờ công chuẩn");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "208");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Lương cơ bản");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "6,070,000");
$rowright = $rowright + $box_width;
drawtext($im, 165, $rowright, "$fontsize", $black, $font, "Ngày nhận việc");
drawtext($im, 165 + 130, $rowright, "$fontsize", $black, $font, "02/06/2020");
////////////////////////////////////////////////// Top right part///////////////////////
//////////////////////////////////////////////////// Middle Part////////////////////////
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width, "Khoản Mục", $font, "$fontsize", $bgcolor, $bordercolor,  $black);
drawcell($im, 105, $im_y, 90 + 15 + 60, $im_y + $box_width, "Đơn vị tính", $font, "$fontsize", $bgcolor, $bordercolor, $black);
drawcell($im, 105 + $box_y, $im_y, 90 + 15 + 60 + $box_y, $im_y + $box_width, "Giờ công TT", $font, "$fontsize",  $bgcolor, $bordercolor,  $black);
drawcell($im, 105 + $box_y * 2, $im_y, 90 + 15 + 60 + $box_y * 2, $im_y + $box_width, "Nghỉ Phép", $font, "$fontsize", $bgcolor, $bordercolor,   $black);
drawcell($im, 105 + $box_y * 3, $im_y, 90 + 15 + 60 + $box_y * 3, $im_y + $box_width, "Nghỉ chế độ", $font, "$fontsize",  $bgcolor, $bordercolor,   $black);
drawcell($im, 105 + $box_y * 4, $im_y, 90 + 15 + 60 + $box_y * 4, $im_y + $box_width, "Nghỉ KL", $font, "$fontsize",  $bgcolor, $bordercolor,  $black);
drawcell($im, 105 + $box_y * 5, $im_y, 90 + 15 + 60 + $box_y * 5, $im_y + $box_width, "Lương", $font, "$fontsize", $bgcolor, $bordercolor,   $black);
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width, "Lương ngày công",  $font, "$fontsize", $white, $bordercolor, $black);
drawcell($im, 105, $im_y, 90 + 15 + 60, $im_y + $box_width, "Giờ", $font, "$fontsize", $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y, 90 + 15 + 60 + $box_y, $im_y + $box_width,  "196", $font, "$fontsize", $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y * 2, $im_y, 90 + 15 + 60 + $box_y * 2, $im_y + $box_width, "0", $font, "$fontsize",  $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y * 3, $im_y, 90 + 15 + 60 + $box_y * 3, $im_y + $box_width, "0",  $font, "$fontsize",  $white, $bordercolor, $black);
drawcell($im, 105 + $box_y * 4, $im_y, 90 + 15 + 60 + $box_y * 4, $im_y + $box_width, "0",  $font, "$fontsize",  $white, $bordercolor, $black);
drawcell($im, 105 + $box_y * 5, $im_y, 90 + 15 + 60 + $box_y * 5, $im_y + $box_width, "5,719,808",  $font, "$fontsize", $white, $bordercolor,  $black);
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Tiền làm thêm giờ",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Giờ",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "503,401",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Số giờ làm thêm", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "11,5", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
wraptext($im, 15, $im_y, 90 + 15, $im_y + $box_width2,"Phụ cấp trách nhiệm",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width2, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width2, "660,000",  $font, $fontsize, $white, $bordercolor,  $black);
wraptextmiddle($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width2, "Phụ cấp kiêm nhiệm, xe nâng, kiếm việc", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width2,  "0", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width2;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Hỗ trợ nhà ở",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "300,000",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Trợ cấp sức khoẻ", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "400,000", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Thưởng ABCD",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "400,000",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Thưởng KQCV", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "400,000", $font, $fontsize, $white, $bordercolor,  $black);   
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Phép năm HH, QS",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "583,654",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Tiền ăn giữa ca", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "575,000", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Thưởng KK",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "0",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Thưởng TT", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "0", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Truy lãnh",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "0",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Chế độ 1,5h", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "0", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
wraptextmiddle($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Số tiền lên xuống hàng xe: Tải+Cont",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "0",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Trợ cấp gởi trễ", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "0", $font, $fontsize, $white, $bordercolor,  $black);  
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y,90 + 15 + $box_y*3, $im_y + $box_width2, "Tổng thu nhập",$font,$fontsize,  $bgcolor, $bordercolor,  $blue);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + $box_y*6, $im_y + $box_width2, "9,641,863",$font,$fontsize,  $bgcolor, $bordercolor,  $blue);
$im_y = $im_y + $box_width2;
drawcell($im, 15, $im_y,90 + 15 + $box_y*6, $im_y + $box_width2, "Các khoảng khẩu trừ vào lương 8/2022",$font,$fontsize,  $white, $bordercolor,  $black);
$im_y = $im_y + $box_width2;
wraptextmiddle($im, 15, $im_y, 90 + 15, $im_y + $box_width2,"Khẩu Trừ BHXH bắt buộc (10,5%)",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width2, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width2, "748,650",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width2, "Khẩu trừ thuế TN CN", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width2,  "0", $font, $fontsize, $white, $bordercolor,  $black);
$im_y = $im_y + $box_width2;
wraptext($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Khẩu trừ đoàn phí CĐ",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "42,000",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Tạm ứng", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "200,000", $font, $fontsize, $white, $bordercolor,  $black);
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Truy thu khác",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "0",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "Truy thu tiền thẻ BHYT", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "0", $font, $fontsize, $white, $bordercolor,  $black);
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y, 90 + 15, $im_y + $box_width,"Thu hộ tiền cơm",$font, $fontsize,  $white, $bordercolor,   $black);
drawcell($im, 105 , $im_y, 90 + 15 + 60 , $im_y + $box_width, "Đồng",$font, $fontsize, $white, $bordercolor,   $black);
drawcell($im, 105 + $box_y, $im_y,90 + 15 + 60 + $box_y*3, $im_y + $box_width, "0",  $font, $fontsize, $white, $bordercolor,  $black);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width, "", $font, $fontsize ,$white, $bordercolor,   $black);
drawcell($im, 105 + $box_y*5, $im_y,90 + 15 + 60 + $box_y*5, $im_y + $box_width,  "", $font, $fontsize, $white, $bordercolor,  $black);
$im_y = $im_y + $box_width;
drawcell($im, 15, $im_y,90 + 15 + $box_y*3, $im_y + $box_width2, "Thực nhận",$font,$fontsize,  $bgcolor, $bordercolor,  $blue);
drawcell($im, 105 + $box_y*3, $im_y,90 + 15 + $box_y*6, $im_y + $box_width2, "8,651,213",$font,$fontsize,  $bgcolor, $bordercolor,  $blue);
$im_y = $im_y + $box_width2;
drawcell($im, 15, $im_y,90 + 15 + $box_y*6, $im_y + $box_width2,  "Lưu ý: Đề nghị anh/chị CNV vui lòng tuyệt đối giữ bí mật về lương",  $font, $fontsize, $white, $bordercolor, $red);
//////////////////////////////////////////////////// Middle Part////////////////////////
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);


function drawtext($img, $x, $y, $size, $color, $font, $text)
{

  $wordwrap = wordwrap($text, "45");
  imagettftext($img, $size, 0, $x, $y, $color, $font, $wordwrap);
}

function drawimg($dest, $x, $y, $width, $height, $des_x, $des_y, $src)
{

  $src_img = imagecreatefrompng($src);
  // $background = imagecolorallocate($dest, 0, 0, 0);
  // $src = imagecolortransparent($dest, $background);

  imagealphablending($src_img, false);
  imagesavealpha($src_img, true);


  imagecopy($dest, $src_img, $des_x, $des_y, $x, $y, $width, $height);
  // imagepng($dest);
  // $white = imagecolorallocate($src_img, 255, 255, 255);
  // imagefill($src_img, 0, 0, $white);
};

function drawcell($im, $x, $y, $width, $height, $text, $font, $size, $bgcolor, $bordercolor, $textcolor)
{
  // First we create our bounding box
  // $bbox = imageftbbox($size, 0, $font, $text);

  // // This is our cordinates for X and Y
  // // $w = ;
  // $h = $bbox[1]  - $bbox[7];
  // error_log(
  //   print_r($bbox)
  // );
  $wordwrap = wordwrap($text, 90);

  imagefilledrectangle($im, $x, $y, $width, $height, $bgcolor);
  imagettftext($im, $size, 0, $x + 5, $y / 2 + $height / 2 + 5 , $textcolor, $font, $wordwrap);
  imagerectangle($im, $x, $y, $width, $height, $bordercolor);
};
function wraptext($im, $x, $y, $width, $height, $text, $font, $size, $bgcolor, $bordercolor, $textcolor)
{
  // First we create our bounding box
  // $bbox = imageftbbox($size, 0, $font, $text);

  // // This is our cordinates for X and Y
  // // $w = ;
  // $h = $bbox[1]  - $bbox[7];
  // error_log(
  //   print_r($bbox)
  // );
  $wordwrap = wordwrap($text, 20);

  imagefilledrectangle($im, $x, $y, $width, $height, $bgcolor);
  imagettftext($im, $size, 0, $x + 5, $y / 2 + $height / 2 - 4 , $textcolor, $font, $wordwrap);
  imagerectangle($im, $x, $y, $width, $height, $bordercolor);
};
function wraptextmiddle($im, $x, $y, $width, $height, $text, $font, $size, $bgcolor, $bordercolor, $textcolor)
{
  // First we create our bounding box
  // $bbox = imageftbbox($size, 0, $font, $text);

  // // This is our cordinates for X and Y
  // // $w = ;
  // $h = $bbox[1]  - $bbox[7];
  // error_log(
  //   print_r($bbox)
  // );
  $wordwrap = wordwrap($text, 29);

  imagefilledrectangle($im, $x, $y, $width, $height, $bgcolor);
  imagettftext($im, $size, 0, $x + 5, $y / 2 + $height / 2 - 4 , $textcolor, $font, $wordwrap);
  imagerectangle($im, $x, $y, $width, $height, $bordercolor);
};