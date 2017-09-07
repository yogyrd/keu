<?php
$db_host = 'mitramedicare.com'; // Server Name
$db_user = 'mitramed_view'; // Username
$db_pass = 'viewMM123'; // Password
$db_name = 'mitramed_keu'; // Database Name


//kirim email
//                
                date_default_timezone_set('Etc/UTC');
                require 'assets/PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Debugoutput = 'html';
                $mail->Host = 'mail.mitramedicare.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Username = "it@mitramedicare.com";
                $mail->Password = "IT6ENU1n3";
                $mail->addReplyTo("it@mitramedicare.com", "IT Mitra Medicare");
                $mail->setFrom('it@mitramedicare.com', 'IT Mitra Medicare');
                $mail->Subject = 'Approval Transaksi Kas Keluar' ;
                $mail->AddAddress('yogy.rd24@gmail.com');
                $mail->IsHTML(true);
                $mail->Body='Nrp : 214310260 Nama : Yogy Rachmad Dharmawan';
                $mail->Send();
                if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    echo "Message sent!";
                }
//$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//if (!$conn) {
//	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
//}
//$alamat = '';
//$sql = 'SELECT locid FROM masterlokasi';
//		
//$query = mysqli_query($conn, $sql);
//
//if (!$query) {
//	die ('MySQL Error: ' . mysqli_error($conn));
//}
//while ($row = mysqli_fetch_assoc($query)) {
//        //View data transaksi yang belum diapprove
//        $sql_data = "select a.transoutid, a.notrans, a.nilaidetailid, a.keterangan, a.nomorfaktur, b.outid, c.jenis, a.loc, d.locationket, a.transtgl, a.bebantgl, a.createddate, a.nilaiuang, b.nilaimax, c.pengajuan
//                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
//                    inner join accmasterpengeluaran c on b.outid=c.outid
//                    inner join masterlokasi d on a.loc=d.locid
//                    where accuserstatus = 0 and closed = 0 and a.loc=" . $row['locid'];
//        $result_data = mysqli_query($conn, $sql_data);
//        if ($result_data->num_rows > 0) {
//            
//            
//            
//            echo $row['locid'] . '. ';
//            $sql_email = "SELECT email FROM users where group_user=4 and location=". $row['locid'] ." and email is not null";
//            $result_email = mysqli_query($conn, $sql_email);
//            
//            $jum_email =  mysqli_num_rows($result_email);
//            $counter = 0;
//            while( $array_email = mysqli_fetch_array($result_email) ) {
//                $counter++;
//               
//                $alamat = $array_email["email"];
//                
//                if ($counter < $jum_email) {
//                    $alamat .= ',';
//                } 
//                echo $alamat;
//                
//            }
//            
//        }
//        
//        echo '<br>';
//}


