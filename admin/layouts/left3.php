

<ul id="menu">
	<li>
		<a href="#">예약관리</a>
		<ul>
			<li class="d3"><a href="/admin/realpan/index"  class="<?=($this->uri->segment(2)=='realpan')?'selected':''?>">객실관리 <!--span class="badge ">3</span-->  </a>  </a></li>
			<li class="d3"><a href="/admin/calendar/index"  class="<?=($this->uri->segment(2)=='calendar')?'selected':''?>">예약관리 <!--span class="badge ">3</span-->  </a>  </a></li>
            <li class="d3"><a href="/admin/varprice_month/index"  class="<?=($this->uri->segment(2)=='varprice_month')?'selected':''?>">월별 가격관리   </a>  </a></li>
            <li class="d3"><a href="/admin/varprice/index"  class="<?=($this->uri->segment(2)=='varprice')?'selected':''?>">일별 가격관리   </a>  </a></li>
		</ul>
	</li>
</ul>
