TYPE=VIEW
query=select `U`.`name` AS `name`,`U`.`phone` AS `phone`,`U`.`address` AS `address`,`X`.`g_name` AS `g_name`,`G`.`g_icon` AS `g_icon`,`G`.`g_type` AS `g_type`,`X`.`id` AS `id`,`X`.`uid` AS `uid`,`X`.`gid` AS `gid`,`X`.`status` AS `status`,`X`.`cpid` AS `cpid`,`X`.`created_at` AS `created_at`,`X`.`updated_at` AS `updated_at` from ((`spin`.`user_gifts` `X` join `spin`.`users` `U` on(`X`.`uid` = `U`.`uid`)) join `spin`.`gifts` `G` on(`G`.`gid` = `X`.`gid`))
md5=c8390a242b8c4cc7d92c9c1e12364439
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2020-10-15 13:24:13
create-version=2
source=select `U`.`name` AS `name`,`U`.`phone` AS `phone`,`U`.`address` AS `address`,`X`.`g_name` AS `g_name`,`G`.`g_icon` AS `g_icon`,`G`.`g_type` AS `g_type`,`X`.`id` AS `id`,`X`.`uid` AS `uid`,`X`.`gid` AS `gid`,`X`.`status` AS `status`,`X`.`cpid` AS `cpid`,`X`.`created_at` AS `created_at`,`X`.`updated_at` AS `updated_at` from ((`user_gifts` `X` join `users` `U` on(`X`.`uid` = `U`.`uid`)) join `gifts` `G` on(`G`.`gid` = `X`.`gid`))
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `U`.`name` AS `name`,`U`.`phone` AS `phone`,`U`.`address` AS `address`,`X`.`g_name` AS `g_name`,`G`.`g_icon` AS `g_icon`,`G`.`g_type` AS `g_type`,`X`.`id` AS `id`,`X`.`uid` AS `uid`,`X`.`gid` AS `gid`,`X`.`status` AS `status`,`X`.`cpid` AS `cpid`,`X`.`created_at` AS `created_at`,`X`.`updated_at` AS `updated_at` from ((`spin`.`user_gifts` `X` join `spin`.`users` `U` on(`X`.`uid` = `U`.`uid`)) join `spin`.`gifts` `G` on(`G`.`gid` = `X`.`gid`))
mariadb-version=100413
