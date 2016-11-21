			<div class="post">	
                <div class="board">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <colgroup>
                            <col width="65%">
                            <col width="1%">
                            <col width="14%">
                            <col width="1%">
                            <col width="9%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="boardtit">제목</th>
                                <th class="boardtit"><img src="<?=FRONT_IMG_DIR?>/sub/bar.jpg"></th>
                                <th class="boardtit">날짜</th>
                                <th class="boardtit"><img src="<?=FRONT_IMG_DIR?>/sub/bar.jpg"></th>
                                <th class="boardtit">조회</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tit_left"><?=$row['title']?></td>
                                <td></td>
                                <td><?=substr( $row['udate'],0,10)?></td>
                                <td></td>
                                <td><?=$row['hits']?></td>
                            </tr>
                            <tr>
                                <td colspan="7" class="board_view"><?=$row['content']?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button"><button type="button" onclick="go_url('/front/board/lists/notice?page=<?=$page?>');"><span>목록</span></button></div>
                </div>
            </div>