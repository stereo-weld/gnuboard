<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키], mo[배열키] 형태로 등록
// 기본은 wset[배열키], 모바일 설정은 mo[배열키] 형식을 가짐

?>

<ul class="list-group">
	<li class="list-group-item">
		<div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">출력 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
					<tbody>
					<tr class="bg-light">
					<th class="text-center nw-c1">구분</th>
					<th class="text-center nw-c2">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<td class="text-center">캐시 설정</td>
					<td>
						<div class="input-group">
							<?php $wset['cache'] = isset($wset['cache']) ? $wset['cache'] : ''; ?>
							<input type="text" name="wset[cache]" value="<?php echo $wset['cache'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">분</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">새 글 표시</td>
					<td>
						<div class="input-group">
							<?php $wset['bo_new'] = isset($wset['bo_new']) ? $wset['bo_new'] : ''; ?>
							<input type="text" name="wset[bo_new]" value="<?php echo $wset['bo_new'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">시</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						기본값 : 24시간 이내 등록 글
					</td>
					</tr>
					<tr>
					<td class="text-center">새 글 색상</td>
					<td class="text-center">
						<?php $wset['new'] = isset($wset['new']) ? $wset['new'] : ''; ?>
						<select name="wset[new]" class="custom-select">
							<option value=""<?php echo get_selected('', $wset['new']); ?>>자동 컬러</option>
							<?php echo na_color_options($wset['new']);?>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">랭크 표시</td>
					<td>
						<?php $wset['rank'] = isset($wset['rank']) ? $wset['rank'] : ''; ?>
						<select name="wset[rank]" class="custom-select">
							<option value=""<?php echo get_selected('', $wset['rank']); ?>>표시 안 함</option>
							<?php echo na_color_options($wset['rank']);?>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">글 이동</td>
					<td class="text-center">
						<?php $wset['target'] = isset($wset['target']) ? $wset['target'] : ''; ?>
						<select name="wset[target]" class="custom-select">
							<?php echo na_target_options($wset['target']);?>
						</select>
					</td>
					<td class="text-muted">
						글 내용 또는 관련 링크1 페이지로 이동
					</td>
					</tr>
					<tr>
					<td class="text-center">보드/분류명</td>
					<td>
						<div class="input-group">
							<?php $wset['bo_name'] = isset($wset['bo_name']) ? $wset['bo_name'] : ''; ?>
							<input type="text" name="wset[bo_name]" value="<?php echo $wset['bo_name'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">자</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						복수 추출시 보드명, 단일 게시판 출력시 분류명 출력 (0 설정시 자르지 않음, 미설정시 출력안함)
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">이미지 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
					<tbody>
					<tr class="bg-light">
					<th class="text-center nw-c1">구분</th>
					<th class="text-center nw-c2">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<td class="text-center">썸네일 너비</td>
					<td>
						<div class="input-group">
							<?php $wset['thumb_w'] = isset($wset['thumb_w']) ? $wset['thumb_w'] : ''; ?>
							<input type="text" name="wset[thumb_w]" value="<?php echo $wset['thumb_w'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">px</span>
							</div>
						</div>
					</td>
					<td class="text-muted">기본값 : 400 - 0 설정시 썸네일 생성 안 함</td>
					</tr>
					<tr>
					<td class="text-center">썸네일 높이</td>
					<td class="text-center">
						<div class="input-group">
							<?php $wset['thumb_h'] = isset($wset['thumb_h']) ? $wset['thumb_h'] : ''; ?>
							<input type="text" name="wset[thumb_h]" value="<?php echo $wset['thumb_h'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">px</span>
							</div>
						</div>
					</td>
					<td class="text-muted">기본값 : 225 - 0 설정시 이미지 비율대로 생성</td>
					</tr>
					<tr>
					<td class="text-center">기본 높이</td>
					<td>
						<div class="input-group">
							<?php $wset['thumb_d'] = isset($wset['thumb_d']) ? $wset['thumb_d'] : ''; ?>
							<input type="text" name="wset[thumb_d]" value="<?php echo $wset['thumb_d'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</td>
					<td class="text-muted">기본값 : 56.25 - 썸네일 높이를 0으로 설정시 적용</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">이미지 가로수</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
					<tbody>
					<tr class="bg-light">
						<th class="text-center nw-c1">구분</th>
						<th class="text-center nw-c2">설정</th>
						<th class="text-center">비고</th>
					</tr>
					<tr>
					<td class="text-center">1200px 이상</td>
					<td>
						<div class="input-group">
							<?php $wset['xl'] = isset($wset['xl']) ? $wset['xl'] : ''; ?>
							<input name="wset[xl]" value="<?php echo ($wset['xl']) ? $wset['xl'] : '4'; ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					<td class="text-muted">PC / 데스크탑 사이즈</td>
					</tr>
					<tr>
					<td class="text-center">992px 이상</td>
					<td>
						<div class="input-group">
							<?php $wset['lg'] = isset($wset['lg']) ? $wset['lg'] : ''; ?>
							<input name="wset[lg]" value="<?php echo ($wset['lg']) ? $wset['lg'] : '4'; ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					<td class="text-muted" rowspan="2">테블릿 사이즈</td>
					</tr>
					<tr>
					<td class="text-center">768px 이상</td>
					<td>
						<div class="input-group">
							<?php $wset['md'] = isset($wset['md']) ? $wset['md'] : ''; ?>
							<input name="wset[md]" value="<?php echo ($wset['md']) ? $wset['md'] : '4'; ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					</tr>
					<tr>
					<td class="text-center">576px 이상</td>
					<td>
						<div class="input-group">
							<?php $wset['sm'] = isset($wset['sm']) ? $wset['sm'] : ''; ?>
							<input name="wset[sm]" value="<?php echo ($wset['sm']) ? $wset['sm'] : '3'; ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					<td class="text-muted" rowspan="2">모바일 사이즈</td>
					</tr>
					<tr>
					<td class="text-center">0px 이상</td>
					<td>
						<div class="input-group">
							<?php $wset['xs'] = isset($wset['xs']) ? $wset['xs'] : ''; ?>
							<input name="wset[xs]" value="<?php echo ($wset['xs']) ? $wset['xs'] : '2'; ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">추출 대상</label>
			<div class="col-sm-10">
				<p class="form-control-plaintext">
					<i class="fa fa-caret-right" aria-hidden="true"></i>
					콤마(,)로 구분해서 복수 등록 가능하며, 그룹 또는 복수 게시판 추출시 검색 가능한 게시판만 추출됨
				</p>
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
					<tbody>
					<tr class="bg-light">
					<th class="text-center nw-c1">구분</th>
					<th class="text-center">대상 설정</th>
					<th class="text-center nw-c1">제외 설정</th>
					</tr>
					
					<tr>
					<td class="text-center">게시판 그룹</td>
					<td>
						<?php $wset['gr_list'] = isset($wset['gr_list']) ? $wset['gr_list'] : ''; ?>
						<input type="text" name="wset[gr_list]" value="<?php echo $wset['gr_list'] ?>" class="form-control" placeholder="그룹아이디(gr_id)">
					</td>
					<td class="text-center">
						<div class="custom-control custom-checkbox">
							<?php $wset['gr_except'] = isset($wset['gr_except']) ? $wset['gr_except'] : ''; ?>
							<input type="checkbox" name="wset[gr_except]" value="1"<?php echo get_checked('1', $wset['gr_except'])?> class="custom-control-input" id="idCheck<?php echo $idn ?>">
							<label class="custom-control-label" for="idCheck<?php echo $idn; $idn++; ?>"></label>
						</div>
					</td>
					</tr>
					<tr>
					<td class="text-center">게시판</td>
					<td>
						<?php $wset['bo_list'] = isset($wset['bo_list']) ? $wset['bo_list'] : ''; ?>
						<input type="text" name="wset[bo_list]" value="<?php echo $wset['bo_list'] ?>" class="form-control" placeholder="게시판아이디(bo_table)">
					</td>
					<td class="text-center">
						<div class="custom-control custom-checkbox">
							<?php $wset['bo_except'] = isset($wset['bo_except']) ? $wset['bo_except'] : ''; ?>
							<input type="checkbox" name="wset[bo_except]" value="1"<?php echo get_checked('1', $wset['bo_except'])?> class="custom-control-input" id="idCheck<?php echo $idn ?>">
							<label class="custom-control-label" for="idCheck<?php echo $idn; $idn++; ?>"></label>
						</div>
					</td>
					</tr>
					<tr>
					<td class="text-center">글 분류</td>
					<td>
						<?php $wset['ca_list'] = isset($wset['ca_list']) ? $wset['ca_list'] : ''; ?>
						<input type="text" name="wset[ca_list]" value="<?php echo $wset['ca_list'] ?>" class="form-control" placeholder="분류명(ca_name) - 단일게시판 추출시에만 작동함">
					</td>
					<td class="text-center">
						<div class="custom-control custom-checkbox">
							<?php $wset['ca_except'] = isset($wset['ca_except']) ? $wset['ca_except'] : ''; ?>
							<input type="checkbox" name="wset[ca_except]" value="1"<?php echo get_checked('1', $wset['ca_except'])?> class="custom-control-input" id="idCheck<?php echo $idn ?>">
							<label class="custom-control-label" for="idCheck<?php echo $idn; $idn++; ?>"></label>
						</div>
					</td>
					</tr>
					<tr>
					<td class="text-center">등록 회원</td>
					<td>
						<?php $wset['mb_list'] = isset($wset['mb_list']) ? $wset['mb_list'] : ''; ?>
						<input type="text" name="wset[mb_list]" value="<?php echo $wset['mb_list'] ?>" class="form-control" placeholder="회원아이디(mb_id)">
					</td>
					<td class="text-center">
						<div class="custom-control custom-checkbox">
							<?php $wset['mb_except'] = isset($wset['mb_except']) ? $wset['mb_except'] : ''; ?>
							<input type="checkbox" name="wset[mb_except]" value="1"<?php echo get_checked('1', $wset['mb_except'])?> class="custom-control-input" id="idCheck<?php echo $idn ?>">
							<label class="custom-control-label" for="idCheck<?php echo $idn; $idn++; ?>"></label>
						</div>
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">추출 옵션</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
					<tbody>
					<tr class="bg-light">
					<th class="text-center nw-c1">구분</th>
					<th class="text-center nw-c2">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<?php if(IS_NA_BBS) { ?>
					<tr>
					<td class="text-center">메인글</td>
					<td class="text-center">
						<div class="custom-control custom-checkbox">
							<?php $wset['main'] = isset($wset['main']) ? $wset['main'] : ''; ?>
							<input type="checkbox" name="wset[main]" value="1"<?php echo get_checked('1', $wset['main'])?> class="custom-control-input" id="idCheck<?php echo $idn ?>">
							<label class="custom-control-label" for="idCheck<?php echo $idn; $idn++; ?>"></label>
						</div>
					</td>
					<td class="text-muted">
						메인글 체크된 게시물만 추출
					</td>
					</tr>
					<?php } ?>
					<tr>
					<td class="text-center">PC 목록수</td>
					<td>
						<div class="input-group">
							<?php $wset['rows'] = isset($wset['rows']) ? $wset['rows'] : ''; ?>
							<input type="text" name="wset[rows]" value="<?php echo $wset['rows'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">모바일 목록수</td>
					<td>
						<div class="input-group">
							<?php $mo['rows'] = isset($mo['rows']) ? $mo['rows'] : ''; ?>
							<input type="text" name="mo[rows]" value="<?php echo $mo['rows'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">개</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">추출 페이지</td>
					<td>
						<div class="input-group">
							<?php $wset['page'] = isset($wset['page']) ? $wset['page'] : ''; ?>
							<input type="text" name="wset[page]" value="<?php echo $wset['page'] ?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">쪽</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						추출 목록수 기준 페이지임
					</td>
					</tr>
					<tr>
					<td class="text-center">정렬 방법</td>
					<td>
						<?php $wset['sort'] = isset($wset['sort']) ? $wset['sort'] : ''; ?>
						<select name="wset[sort]" class="custom-select">
							<?php echo na_sort_options($wset['sort']);?>
						</select>
					</td>
					<td class="text-muted">
						복수 게시판 추출시 날짜 정렬만 작동함
					</td>
					</tr>
					<tr>
					<td class="text-center">기간 설정</td>
					<td>
						<?php $wset['term'] = isset($wset['term']) ? $wset['term'] : ''; ?>
						<select name="wset[term]" class="custom-select">
							<?php echo na_term_options($wset['term']);?>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>
					<tr>
					<td class="text-center">일자 지정</td>
					<td>
						<div class="input-group">
							<?php $wset['dayterm'] = isset($wset['dayterm']) ? $wset['dayterm'] : ''; ?>
							<input type="text" name="wset[dayterm]" value="<?php echo $wset['dayterm'];?>" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">일</span>
							</div>
						</div>
					</td>
					<td class="text-muted">
						기간 설정에서 일자 지정시 작동함
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

</ul>
