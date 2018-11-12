<div class="thumbnail">
            <div class="row">
              <div class="col-xs-1">
                <img src="user_profile_img/<?php echo $feed_each["profile_image"] ?>" width="40">
              </div>
              <div class="col-xs-11">
                <?php echo $feed_each["name"] ?><br>
                <a href="#" style="color: #7F7F7F;"><?php echo $feed_each["created"] ?></a>
     
            </div>
            <div class="row feed_content">
              <div class="col-xs-12" >
                <span style="font-size: 24px;"><?php echo $feed_each["feed"] ?></span>
              </div>
            </div>
            <div class="row feed_sub">
              <div class="col-xs-12">
                <span hidden class="feed-id" ><?= $feed_each["id"] ?></span>
                <!-- ループで何回も出力されるものはidでなくclass -->
                <!-- イイねボタン自体にfeedのidが何番かを指定 -->
                  <button class="btn btn-default btn-xs js-like">
                    <!-- クラスはたくさん設定できる。 -->
                  <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span>いいね!</span>
                </button>
                <span>いいね数 : </span>
                <span class="like_count"><?php echo $feed_each['like_count'] ?></span>
                <span class="comment_count">コメント数 : 9</span>
                <!-- 編集はサインインしているIDがデーターベースのIDと同じであれば表示-->
                <?php if ($feed_each["user_id"] == $signin_user["id"]) :?>
                  <!-- GET送信でedit.phpに送信する -->
                  <a href="edit.php?feed_id=<?php echo $feed_each['id']; ?>" class="btn btn-success btn-xs">編集</a>
                  <a onclick="return confirm('本当に消すの？');" href = "delete.php?feed_id=<?php echo $feed_each['id']; ?>" class="btn btn-danger btn-xs">削除</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        