<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<script src="http://jq22.qiniudn.com/masonry-docs.min.js"></script>
<!--商品 wrap 开始-->
<div class="wrap w1200">
    <div class="Current_nav w1200"><a href="index.html">首页</a> &gt; 晒单分享</div>
    <div class="share_Curtit">
        <h1 class="fl">
            晒单分享</h1>
        <span>(共<em class="c_red"><?php echo $total; ?></em>个幸运获得者晒单)</span>
    </div>
    <div class="share_list">
        <div class="goods_share_listC">
            <ul>                
                <li>
                    <?php if(is_array($sa_one)) foreach($sa_one AS $sd): ?>
                    <?php if($sd): ?>
                    <div class="share_list_content">
                        <dl>
                            <dt><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
                            <dd class="share-name gray02"> 
                                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="name-img">                               
                                 <?php if(get_user_key($sd['sd_userid'],'img','8080')): ?>                                    
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sd['sd_userid']); ?>.8080.jpg" width="50" height="50" border="0"/>
                                <?php  else: ?>
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0"/>
                                <?php endif; ?>  
                                </a>
                                <div class="share-name-r"> 
                                    <span class="gray03"> <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="blue"><?php echo get_user_name($sd['sd_userid'],'username'); ?></a><?php echo date("Y-m-d H:i",$sd['sd_time']); ?></span>
                                    <span class="gray03"><a class="Fb gray01" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></span>
                                </div> 
                            </dd> 
                            <dd class="share_info gray01"><?php echo _strcut($sd['sd_content'],50); ?></dd> 
                            <dd class="message hidden" style="display: block;"> 
                                <span class="smile gray03"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i><b>羡慕(<em num="1282"><?php echo $sd['sd_zhan']; ?></em>)</b></a></span>
                                <span class="much"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i>评论<em>(<?php echo $sd['sd_ping']; ?>)</em></a></span>
                            </dd>
                        </dl>
                        <p class="text-h10"></p>
                    </div>
                    <?php endif; ?>                 
                    <?php endforeach; ?>
                </li>
                <li>
                    <?php if(is_array($sa_two)) foreach($sa_two AS $sd): ?>
                    <?php if($sd): ?>
                    <div class="share_list_content">
                        <dl>
                            <dt><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
                            <dd class="share-name gray02"> 
                                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="name-img">                               
                                 <?php if(get_user_key($sd['sd_userid'],'img','8080')): ?>                                    
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sd['sd_userid']); ?>.8080.jpg" width="50" height="50" border="0"/>
                                <?php  else: ?>
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0"/>
                                <?php endif; ?>                                                                     
                                </a>
                                <div class="share-name-r"> 
                                    <span class="gray03"> <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="blue"><?php echo get_user_name($sd['sd_userid'],'username'); ?></a><?php echo date("Y-m-d H:i",$sd['sd_time']); ?></span>
                                    <span class="gray03"><a class="Fb gray01" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></span>
                                </div> 
                            </dd> 
                            <dd class="share_info gray01"><?php echo _strcut($sd['sd_content'],50); ?></dd> 
                            <dd class="message hidden" style="display: block;"> 
                                <span class="smile gray03"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i><b>羡慕(<em num="1282"><?php echo $sd['sd_zhan']; ?></em>)</b></a></span>
                                <span class="much"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i>评论<em>(<?php echo $sd['sd_ping']; ?>)</em></a></span>
                            </dd>
                        </dl>
                        <p class="text-h10"></p>
                    </div>
                    <?php endif; ?>                 
                    <?php endforeach; ?>
                </li>
                <li>
                    <?php if(is_array($sa_three)) foreach($sa_three AS $sd): ?>
                    <?php if($sd): ?>
                    <div class="share_list_content">
                        <dl>
                            <dt><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
                            <dd class="share-name gray02">                          
                                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="name-img">                               
                                 <?php if(get_user_key($sd['sd_userid'],'img','8080')): ?>                                    
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sd['sd_userid']); ?>.8080.jpg" width="50" height="50" border="0"/>
                                <?php  else: ?>
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0"/>
                                <?php endif; ?>                                     
                                </a>
                                <div class="share-name-r"> 
                                    <span class="gray03"> <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="blue"><?php echo get_user_name($sd['sd_userid'],'username'); ?></a><?php echo date("Y-m-d H:i",$sd['sd_time']); ?></span>
                                    <span class="gray03"><a class="Fb gray01" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></span>
                                </div> 
                            </dd> 
                            <dd class="share_info gray01"><?php echo _strcut($sd['sd_content'],50); ?></dd> 
                            <dd class="message hidden" style="display: block;"> 
                                <span class="smile gray03"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i><b>羡慕(<em num="1282"><?php echo $sd['sd_zhan']; ?></em>)</b></a></span>
                                <span class="much"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i>评论<em>(<?php echo $sd['sd_ping']; ?>)</em></a></span>
                            </dd>
                        </dl>
                        <p class="text-h10"></p>
                    </div>
                    <?php endif; ?>                 
                    <?php endforeach; ?>
                </li>
                <li class="share-liR">  
                    <?php if(is_array($sa_for)) foreach($sa_for AS $sd): ?>
                    <?php if($sd): ?>
                    <div class="share_list_content">
                        <dl>
                            <dt><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
                            <dd class="share-name gray02"> 
                                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="name-img">                               
                                 <?php if(get_user_key($sd['sd_userid'],'img','8080')): ?>                                    
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sd['sd_userid']); ?>.8080.jpg" width="50" height="50" border="0"/>
                                <?php  else: ?>
                                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0"/>
                                <?php endif; ?>                                     
                                </a>
                                <div class="share-name-r"> 
                                    <span class="gray03"> <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>" class="blue"><?php echo get_user_name($sd['sd_userid'],'username'); ?></a><?php echo date("Y-m-d H:i",$sd['sd_time']); ?></span>
                                    <span class="gray03"><a class="Fb gray01" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></span>
                                </div> 
                            </dd> 
                            <dd class="share_info gray01"><?php echo _strcut($sd['sd_content'],50); ?></dd> 
                            <dd class="message hidden" style="display: block;"> 
                                <span class="smile gray03"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i><b>羡慕(<em num="1282"><?php echo $sd['sd_zhan']; ?></em>)</b></a></span>
                                <span class="much"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank"class="gray03"><i></i>评论<em>(<?php echo $sd['sd_ping']; ?>)</em></a></span>
                            </dd>
                        </dl>
                        <p class="text-h10"></p>
                    </div>  
                    <?php endif; ?>
                    <?php endforeach; ?>
                </li>               
            </ul>               
        </div>
        <?php if($total>$num): ?>
            <div class="pagesx"><?php echo $page->show('two'); ?></div> 
        <?php endif; ?> 
    </div>
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>