TRUNCATE TABLE wx_address;
TRUNCATE TABLE wx_bonus;
TRUNCATE TABLE wx_bonustime;
TRUNCATE TABLE wx_broke_record;
TRUNCATE TABLE wx_transfer;
TRUNCATE TABLE wx_transferrecord;
TRUNCATE TABLE wx_transform;
TRUNCATE TABLE wx_upgrade;
TRUNCATE TABLE wx_withdraw;
TRUNCATE TABLE wx_users;
TRUNCATE TABLE wx_centerlists;


INSERT INTO `wx_centerlists` VALUES ('1', '1', 'M000001', '子轩', '1', '2', '3', '申请保单中心', '申请保单中心', '1490162800', '1490178050');


 INSERT INTO `zhixiao`.`wx_users` (`user_id`, `user_name`, `openid`, `wxid`, `nickname`, `truename`, `password`, `second_password`, `headimgurl`, `sex`, `province`, `city`, `country`, `subscribe`, `subscribe_time`, `register`, `pid`, `repath`, `rusername`, `rlevel`, `recount`, `parentid`, `ppath`, `pusername`, `plevel`, `centerid`, `centername`, `area`, `area1`, `area2`, `yarea1`, `jjb`, `gwb`, `dzb`, `axjj`, `sh`, `yarea2`, `chl`, `chr`, `level`, `lsk`, `zb1`, `agent`, `shop_income`, `shop_outcome`, `mey`, `huzhu`, `single`, `maxmey`, `b0`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `daijin`, `daili`, `rank`, `idcard`, `bankid`, `bankno`, `bankuser`, `bankname`, `moblie`, `email`, `zipcode`, `address`, `place`, `last_time`, `reg_time`, `activate_time`, `after_time`) VALUES ('1', 'M000001', 'odUDzsqRHu3bnIUAGS1njwePHcz0', '', 'admin', '刘子轩', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'http://wx.qlogo.cn/mmopen/kiaXicXJs2M4dxtxRkYUC7vKbxL80vUr1zvkKRrySkUFzdjFGPGhWXLncCV2cPB6J1iajg7z8DakreFyqFqD2x4kMcIHDSh63Vy/0', '1', '16', '170', '中国', '1', '1488950385', '1', '0', '', '', '0', '0', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0.00', '0.00', '200000.00', '0.00', '0.00', '0', '0', '0', '5', '30000.00', '0.00', '0', '0.00', '0.00', '0.00', '0.00', '1', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '2', '0', '111', '1', '1', '11', '111', '0', '123', '12', '1', '1726', '1490937826', '0', '0', '0');
