<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css" media="screen">
.mfooter{
    width: 100%;
    height:90px;
    background:black;
    position:fixed;
    bottom:0px;
    z-index:3333;
}
.mfooter ul{
    width: 90%;
    margin:auto;
}
.mfooter ul li{
    width: 25%;
    height:90px;
    float:left;
    text-align:center;
    font-size:20px;
    line-height:50px;
}
.mfooter ul li a{
  color:white;
  font-size:22px;
}
.mfooter ul li a img{
    width: 75px;
    height: 75px;
    margin-top: 9px;
}
#amount {
    display: inline-block;
    position: absolute;
    width: 40px;
    right: 40px;
    height: 40px;
    border: 3px solid white;
    border-radius: 30px;
    line-height: 35px;
    top: 10px;
    font-weight: 800;
    z-index: 100;
    /* display: none; */
}
 </style>
  <div class="mfooter">
        <ul>
            <li>
                <a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=choujiang&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>">
                    <img src="./mindex/game.png" alt="">
                </a>
            </li>
            <li class="ling">
                <a href="<?php  echo $this->createMobileUrl('SendOperatorNotice', array('storeid' => $_GET['storeid'], 'mode' => $_GET['mode'], 'tablesid' => $_GET['tablesid'], 'type' => 1), true)?>">
                    <img src="./mindex/ling.png" alt="">
                </a>
            </li>
            <li>

                <a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=laohuji&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>">
                    <img src="./mindex/prizedraw.png" alt="">
                </a>
            </li>
            <li>
                <a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=orders&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>">
                    <span id="amount" style="display:
                    <?php  if($totalcount>0){
                          echo 'block';
                        }else{
                          echo 'none';

                        }
                     ?>"
                    >
                    <?php  echo $totalcount;?></span>

                    <img src="./mindex/bill.png" alt="">
                </a>
            </li>
        </ul>
    </div>


<script >
$('.ling').click(function(){
navigator.vibrate([3000, 2000, 1000]);
})

</script>