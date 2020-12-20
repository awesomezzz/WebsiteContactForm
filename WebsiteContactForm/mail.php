
<?php
// 	提交的動作交到PHP文檔

    // 利用isset()判斷host變量有無submit存在，成立與否為true/false
    if(isset($_POST["submit"]))
    {
    // 	按下按鈕後將post的變量的name放到php的name裡面
        $name = $_POST["name"];

        $email = $_POST["email"];
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        $message = $_POST["message"];

        // 宣告沒有輸入完整訊息時
        $errorEmpty = false;
        // 宣告沒有輸入正確郵箱格式時
        $errorEmail = false;
        // 宣告沒有輸入正確密碼時
        $errorPass = false;


        // 沒有輸入時:如果其中有格子為空
        if(empty($name) || emtpy($email) || emtpy(pass1) || empty($pass2) || empty($message))
        {
        	echo "<span class='form-error'>請輸入完整訊息</span>"
        // 	此時此部分成立並執行後，修改errorEmpty
        	$errorEmpty = true;
        }
        // 郵箱有誤時:利用elseif判斷
        // 並在PHP可用filter_var($email, FILTER_VALIDATE_EMAIL)來應證email是否符合正規表達式
        // 加入驚嘆號代表，因為fiilter_var若不成立才會執行到此elseif，但執行elseif的括號內需為true，
        // 所以加入驚嘆號始之從false變為true而執行
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "<span class='form-error'>請輸入正確郵箱地址</span>"
            // 此時此部分成立並執行後，修改errorEmail
        	$errorEmail = true;
        }
        // 密碼有誤時:檢查pass1與pass2，同上原理
        elseif($pass1 != $pass2)
        {
            echo "<span class='form-error'>請確認是否輸入相同密碼</span>"
            // 此時此部分成立並執行後，修改errorEmail
        	$errorPass = true;
        }
        // 發送郵件
        else
        {
            $mailToname = "ken-cens.com";
            // 用戶寄到哪邊的信箱(收件地址)
            $mailTo = "kenling@177.com";
            // 用戶的名字
            $mailFromname = $name;
            // 用戶的信箱
            $mailFrom = $mail;
            // 郵件的標題
            $mailSubject = "網站聯繫表單";
            // 郵件內容
            $mailContect = "
            姓名: ".$name."
            訊息內容:
            ".$message;
            // 發送郵件的動作，發送成功時會在下方顯示成功寄出
            // 利用mail()方法來判定成立與否，
            if(mail($mailTo, $mailSubject, $mailContent, $mailFrom))
            {
                echo "<span class='form-success'>郵件已發送成功</span>"
            }
            else
            {
                echo "<span class='form-error'>郵件發送失敗</span>"
            }
        }


    }
    // 當用戶作提交動作失敗可能是網路錯誤，所以加入else提醒用戶稍後再試
    else
    {
    	echo "<span class='form-error'>網路錯誤,稍後再試!</span>"
    }

?>

<!--為了想讓各部分input輸入框有錯誤時的提醒，-->
<!--使用script去接jquery，而由於ajax的緣故，可以用到index.php裡的應用-->
<script>

    // 為了每一次都須清除input框的紅色警告部分
    $("#email-name, #email-address, #pass1, #mail-message").removeClass("input-error");

    // 要先獲得php內的標記變量的值
    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";
    var errorPass = "<?php echo $errorPass; ?>";

    // 接下來就可以用if語句判斷
    if(errorEmpty == true)
    {
        // 要對應到index.php裡的id，此部分可一次性的指向，以addClass添加到input-error的class
        // 讓未輸入時就提交的時候，input框會有紅色框警告
        $("#email-name, #email-address, #pass1, #mail-message").addClass("input-error");

    }
    // 檢查信箱的狀況
    if(errorEmail == true)
    {
        // 要對應到index.php裡的id，此部分可一次性的指向，以addClass添加到input-error的class
        // 讓未輸入時就提交的時候，input框會有紅色框警告
        $("#email-address").addClass("input-error");

    }
    // 檢查密碼的狀況
    if(errorPass == true)
    {
        // 要對應到index.php裡的id，此部分可一次性的指向，以addClass添加到input-error的class
        // 讓未輸入時就提交的時候，input框會有紅色框警告
        $("#pass1, pass2").addClass("input-error");

    }


</script>
