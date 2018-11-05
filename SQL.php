<?php 
SELECT * FROM `feeds` INNER JOIN `users` ON `feeds`. `user_id` = `users`.`id`

//必要なカラムだけを指定して取得
SELECT `feeds`.*, `users`.`name`, `users`.`img_name` FROM `feeds` INNER JOIN `users` ON `feeds`. `user_id` = `users`.`id`

//同じカラム名がつけられていたら、別名をつけられる
SELECT `feeds`.*, `users`.`name`, `users`.`img_name` AS `profile_image` FROM `feeds` INNER JOIN `users` ON `feeds`. `user_id` = `users`.`id`

SQL文の中で、Feeds→f、Users→uと短縮できる。FROMがファイル名になるので、ASを使うのはFROMの中。
SELECT `feeds`.*, `users`.`name`, `users`.`img_name` AS `profile_image` FROM `feeds` AS `f` INNER JOIN `users` AS `u` ON `f`. `user_id` = `u`.`id`

//ORDER BY句を追加
SELECT `f`.*, `u`.`name`, `u`.`img_name` AS `profile_image` FROM `feeds` AS `f` INNER JOIN `users` AS `u` ON `f`. `user_id` = `u`.`id` ORDER BY `created` DESC

?>