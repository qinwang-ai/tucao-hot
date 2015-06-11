<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div class = "content_">

                                               <!-- //sync  item/view.php -->
    <?php foreach ($item_models as $model):?>
	<div class = "row" id = "item<?php echo $model->item_id;?>" >
		<div class="ui segment">
			<h3 class="ui header" onclick = "window.open('<?php echo $this->createUrl('item/'.$model->item_id)?>')">
                <?php echo $model->item_title;?>
            </h3>
		  	<div class="ui clearing divider"></div>
		  	<p>
                <?php echo $model->item_detail;?>
			</p>

            <?php if($model->item_picture != Null && $model->item_picture !=''):?>
            <img src = <?php echo $model->item_picture;?> class = "ui tucaoimg">
            <?php endif;?>

			<div class = "ding ui segment basic">
				<div class="ui up teal label" onclick = "ding(<?php echo $model->item_id;?>)">
					<i class=" thumbs up outline icon"></i><?php echo $model->zan_times;?>
				</div>
				<div class="ui down label" onclick = "cai(<?php echo $model->item_id;?>)">
					<i class="thumbs down outline icon"></i><?php echo $model->cai_times;?>
				</div>
			</div>

            <div class = "ui label bottom right attached" style = "font-size:smaller">
                    <?php
                        echo $model->publisher.' ';echo
                        date( "M d H:i",$model->publish_time);
                    ?>
            </div>

<!--  share begin-->
            <div class="bshare-custom">
                <a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到微信" class="bshare-weixin"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到QQ好友" class="bshare-qqim"></a>
                <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span>
            </div>
                <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=6f38cb36-3acf-4a26-9580-3e913c32b881&amp;pophcol=2&amp;lang=zh"></script>
                <a class="bshareDiv" onclick="javascript:return false;">
                </a>
                <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js">
                </script>
                <script type="text/javascript" charset="utf-8">
                bShare.addEntry({
                    title: "<?php echo $model->item_title;?>",
                    url: "http://tucao-hot.com/index.php/item/<?php echo $model->item_id;?>",
                    pic: "http://tucao-hot.com<?php echo $model->item_picture;?>"
                });
                </script>
<!--  share end-->

		</div>
	</div>
    <?php endforeach;?>



    <?php if (!isset( $_GET['id']))$_GET['id'] = 1;?>
    <div class="ui pagenum circular labels" style = "text-align:center">

        <?php if ($_GET['id']>1):?>
        <a class="icon item ui label" href = "?id=<?php echo $_GET['id']-1;?>">
          <i class="left arrow icon"></i>
        </a>
        <?php endif;?>

        <?php for($i = max(1,$_GET['id'] - 3);$i<= min( $_GET['id']+3, $count);$i++):?>
        <a class="ui label " <?php if($i == (int)$_GET['id']) { echo 'id="active"';}?>" href = "?id=<?php echo $i;?>">
            <?php echo $i;?>
        </a>
        <?php endfor;?>

        <?php if ($_GET['id']<$count):?>
        <a class="icon item ui label" href = "?id=<?php echo $_GET['id']+1;?>">
          <i class="right arrow icon"></i>
        </a>
        <?php endif;?>

    </div>

</div>

<div class = "sider_">
	<div class="ui buttons" style = "margin-left:30px">
		<a class="ui button" href = "<?php echo $this->createUrl('site/index',array('cate'=>'pop'))?>">按人气排序</a>
		<div class="or" data-text="或"></div>
		<a class="ui positive button" href = "<?php echo $this->createUrl('site/index')?>">按时间排序</a>
	</div>
</div>
