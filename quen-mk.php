<?php

require '../../global.php';
require '../../dao/khach-hang.php';
require "../../PHPMailer/src/PHPMailer.php";
require "../../PHPMailer/src/SMTP.php";
require '../../PHPMailer/src/Exception.php';


extract($_REQUEST);
$VIEW_NAME = 'tai-khoan/quen-mk-form.php';
if (exist_param('btn_forgot_pass')) {
    # code...
    $user = khach_hang_select_by_email($email);
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    if ($user) {
        if ($user['email'] != $email) {
            $MESSAGE = 'Sai email đăng nhập';
        } else {
             $MESSAGE = "Mật khẩu của bạn là :" . $user['mat_khau'];
             global $email;
             $VIEW_NAME = 'tai-khoan/dang-nhap-form.php';
            //echo "đúng rồi đấy";
        }
        try {
            //Server settings
            $mail->isSMTP(); // gửi mail SMTP
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  // khai báo SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $nguoigui = 'datd9079@gmail.com'; // Tài khoản Email
            $matkhau   = 'jttxbkjlpzzojrbd'; 
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // Port kết nối: khai báo 465 hoặc 587                


            // Recipients - Người nhận
            $tennguoigui = $name; // Tên người gửi lấy từ form nhập
            $mail->Username = $nguoigui; // SMTP username
            $mail->Password = $matkhau;   // SMTP password
            $mail->setFrom($nguoigui, $tennguoigui); //mail và tên người nhận 
            $to = $email; // Email cần gửi đến lấy từ form nhập
            $to_name = "Nguyen Dat"; // Tên người cần gửi đến

            // Content 
            $mail->addAddress($to, $to_name); //mail và tên người nhận  
            $mail->isHTML(true);  // Khai báo nội dung email hiển thị định dạng html
            $mail->Subject = 'Khôi phục mật khẩu'; // Tiêu đề email
            $mail->Body = $MESSAGE; // Nội dung email

            $mail->send(); // Tiến hành gửi thư
            echo '<script language="javascript">
                    alert("Mật khẩu của bạn đã được gửi đến Email !");
                    window.location = "dang-nhap.php";
                 </script>';
        }
        // nếu ở trên lỗi thì CATCH sẽ chạy
        catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
        }
    } else {
        $MESSAGE = 'Sai tên đăng nhập';
    }
}











// require '../layout.php';


// if (exist_param('btn_forgot_pass')) {
//     $user = khach_hang_select_by_email($email);
//         if($user){
//             if ($user['email'] != $email) {
//                 $MESSAGE = 'Sai email đăng nhập';
//         } else {
//             echo"đúng rồi đấy";
//         }

// }
// }

require '../layout.php';