
			<div class="post">
                <div class="board">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <colgroup>
                            <col width="9%">
                            <col width="1%">
                            <col width="65%">
                            <col width="1%">
                            <col width="14%">
                            <col width="1%">
                            <col width="9%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="boardtit">번호</th>
                                <th class="boardtit"><img src="<?=FRONT_IMG_DIR?>/sub/bar.jpg"></th>
                                <th class="boardtit">제목</th>
                                <th class="boardtit"><img src="<?=FRONT_IMG_DIR?>/sub/bar.jpg"></th>
                                <th class="boardtit">날짜</th>
                                <th class="boardtit"><img src="<?=FRONT_IMG_DIR?>/sub/bar.jpg"></th>
                                <th class="boardtit">조회</th>
                            </tr>
                        </thead>
                        <tbody>

						<? if(is_array($loopno)): ?>
						   <?foreach($loopno as $rowno): ?>			
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td><span>공지</span></td>
                                <td></td>
                                <td class="tit_left"  onclick="go_url('/front/board/v/<?=$rowno['code']?>?page=<?=$page?>&idx=<?=$rowno[idx]?>');" ><?=$rowno['title']?></td>
                                <td></td>
                                <td><?=substr( $rowno['udate'] , 0 , 10)?></td>
                                <td></td>
                                <td><?=$rowno['hits']?></td>
                            </tr>
						   <? endforeach; ?>
						<? endif; ?>

						<? if(is_array($loop)): ?>
						   <?foreach($loop as $row): ?>		

                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td><?=$row['listNo']?></td>
                                <td></td>
                                <td class="tit_left" onclick="go_url('/front/board/v/<?=$row['code']?>?page=<?=$page?>&idx=<?=$row[idx]?>');"><?=$row['title']?></td>
                                <td></td>
                                <td><?=substr( $row['udate'] , 0 , 10)?></td>
                                <td></td>
                                <td><?=$row['hits']?></td>
                            </tr>
						   <? endforeach; ?>
						<? endif; ?>	
                            <!--tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td><span>공지</span></td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>8</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>7</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>6</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>5</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>4</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>3</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>2</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr>
                            <tr onmouseover="this.style.background='#F4F4F4';" onmouseout="this.style.background='#ffffff';">
                                <td>1</td>
                                <td></td>
                                <td class="tit_left">2</td>
                                <td></td>
                                <td>2016-06-20</td>
                                <td></td>
                                <td>3</td>
                            </tr-->

                        </tbody>
                    </table>
                    <!--div class="paging">
                        <ul>
                        <li>&lt;</li>
                        <li class="on">1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li>&gt;</li>
                        </ul>
                    </div-->

					<div style="width:100%;float:left;text-align:center;padding-top:10px;">
						<ul class="pagination">
							<li><a href="javascript:;" onclick="go_url('/front/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['first']?>&title=<?=$title?>');" ><i class="fa fa-angle-double-left"></i></a></li>
							<li><a href="javascript:;" onclick="go_url('/front/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['prev']?>&title=<?=$title?>');" ><i class="fa fa-angle-left"></i></a></li>
							<?foreach($paging['block'] as $rows): ?>
							<li class="<? if ( $rows['equal']==1 ) { ?> active <? } ?>"><a href="javascript:;" onclick="go_url('/front/board/lists/<?=$this->uri->segment(4)?>?page=<?=$rows['num']?>&title=<?=$title?>');" ><?=$rows['num']?></a></li>
							<!-- <li><a href="javascript:;">2</a></li> -->
							<? endforeach;?>
							<li><a href="javascript:;" onclick="go_url('/front/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['next']?>&title=<?=$title?>');" ><i class="fa fa-angle-right"></i></a></li>
							<li><a href="javascript:;" onclick="go_url('/front/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['last']?>&title=<?=$title?>');"><i class="fa fa-angle-double-right"></i></a></li>
						</ul>				
					</div>

                </div>
			</div>



	<link rel="stylesheet" type="text/css" href="<?=ADMIN_CSS_DIR?>/font-awesome.min.css" />
	<style>

/*페이징*/
.area-pagination {
	text-align: center;
}

.pagination {
    border-radius: 4px;
    display: inline-block;
    margin: 20px 0;
    padding-left: 0;
}

.pagination > li {
    display: inline;
}
.pagination > li > a, .pagination > li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    float: left;
    line-height: 1.42857;
    margin-left: -1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
	color:#999;
}
.pagination > li:first-child > a, .pagination > li:first-child > span {
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    margin-left: 0;
}
.pagination > li:last-child > a, .pagination > li:last-child > span {
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
}
.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
    background-color: #eee;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    background-color: #333;
    border-color: #333;
    color: #fff;
    cursor: default;
    z-index: 2;
}
.pagination > .disabled > span, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
    background-color: #fff;
    border-color: #ddd;
    color: #999;
    cursor: not-allowed;
}


	</style>


