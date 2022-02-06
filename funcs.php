<?php
//XSS対応（ echoする場所で使用！）
// 重要な機能を関数化するためのファイル,何度も同じコードを書かなくてもよくなる
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
function db_conn(){
    try {
        $db_name = "";    //データベース名
        $db_id   = "";      //アカウント名
        $db_pw   = "";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = ""; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; //ここを追記！！
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)引数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}



//リダイレクト関数: redirect($file_name)引数　リダイレクトするページをindexではなく変数化
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}


//ログインチェック セッションに保存しているIDと今のIDが同じでなければエラー
function loginCheck(){
    if( $_SESSION["chk_ssid"] != session_id() ){
      exit('LOGIN ERROR');
    }else{
      session_regenerate_id(true);
      // 一致していたら、IDを更新して新しいIDを保存
      $_SESSION['chk_ssid'] = session_id();
    }
  }