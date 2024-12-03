<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<ul class="list-group list-group-flush border-bottom mb-0">
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">기본 설정</label>
			<div class="col-md-10">

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">NO 이미지</label>
					<div class="col-md-10">
						<?php $boset['no_img'] = isset($boset['no_img']) ? $boset['no_img'] : ''; ?>
						<div class="input-group">
							<span class="input-group-text">
								<a href="<?php echo G5_THEME_URL ?>/app/image.php?fid=no_img&amp;type=noimg" class="win_point">
									<i class="bi bi-image"></i>
								</a>
							</span>
							<input type="text" id="no_img" name="boset[no_img]" value="<?php echo $boset['no_img'] ?>" class="form-control" placeholder="https://...">
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">분류 설정</label>
			<div class="col-md-10">
				<div class="row gx-2">
					<label class="col-md-2 col-form-label">분류 스킨</label>
					<div class="col-md-6 col-lg-4">
						<select name="boset[cate_skin]" class="form-select" onchange="change_skin('category_skin', 'category', this.value);">
						<?php
							$boset['category_skin'] = isset($boset['category_skin']) ? $boset['category_skin'] : 'basic';
							$skinlist = na_dir_list($board_skin_path.'/category');
							for ($k=0; $k<count($skinlist); $k++) {
								echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['category_skin']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
							} 
						?>
						</select>				
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							보드 스킨 내 /category 폴더
						</div>
					</div>
				</div>

				<?php $is_setup_skin = is_file($board_skin_path.'/category/'.$boset['category_skin'].'/setup.skin.php') ? true : false; ?>
				<div id="category_skin" class="pt-2 m-0<?php echo ($is_setup_skin) ? '' : ' d-none';?>">
					<?php @include_once($board_skin_path.'/category/'.$boset['category_skin'].'/setup.skin.php'); ?>
				</div>

			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">목록 설정</label>
			<div class="col-md-10">
				<div class="row gx-2">
					<label class="col-md-2 col-form-label">목록 스킨</label>
					<div class="col-md-6 col-lg-4">
						<select name="boset[list_skin]" class="form-select" onchange="change_skin('list_skin', 'list', this.value);">
						<?php
							$boset['list_skin'] = isset($boset['list_skin']) ? $boset['list_skin'] : 'list';
							$skinlist = na_dir_list($board_skin_path.'/list');
							for ($k=0; $k<count($skinlist); $k++) {
								echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['list_skin']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
							} 
						?>
						</select>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							보드 스킨 내 /list 폴더
						</div>
					</div>
				</div>

				<?php $is_setup_skin = is_file($board_skin_path.'/list/'.$boset['list_skin'].'/setup.skin.php') ? true : false; ?>
				<div id="list_skin" class="pt-2 m-0<?php echo ($is_setup_skin) ? '' : ' d-none';?>">
					<?php @include_once($board_skin_path.'/list/'.$boset['list_skin'].'/setup.skin.php'); ?>
				</div>

			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">보기 설정</label>
			<div class="col-md-10">
				<div class="row gx-2">
					<label class="col-md-2 col-form-label">보기 스킨</label>
					<div class="col-md-6 col-lg-4">
						<select name="boset[view_skin]" class="form-select" onchange="change_skin('view_skin', 'view', this.value);">
						<?php
							$boset['view_skin'] = isset($boset['view_skin']) ? $boset['view_skin'] : 'basic';
							$skinlist = na_dir_list($board_skin_path.'/view');
							for ($k=0; $k<count($skinlist); $k++) {
								echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['view_skin']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
							} 
						?>
						</select>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							보드 스킨 내 /view 폴더
						</div>
					</div>
				</div>

				<?php $is_setup_skin = is_file($board_skin_path.'/view/'.$boset['view_skin'].'/setup.skin.php') ? true : false; ?>
				<div id="view_skin" class="pt-2 m-0<?php echo ($is_setup_skin) ? '' : ' d-none';?>">
					<?php @include_once($board_skin_path.'/view/'.$boset['view_skin'].'/setup.skin.php'); ?>
				</div>

			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">댓글 설정</label>
			<div class="col-md-10">
				<div class="row gx-2">
					<label class="col-md-2 col-form-label">댓글 스킨</label>
					<div class="col-md-6 col-lg-4">
						<select name="boset[comment_skin]" class="form-select" onchange="change_skin('comment_skin', 'comment', this.value);">
						<?php
							$boset['comment_skin'] = isset($boset['comment_skin']) ? $boset['comment_skin'] : 'basic';
							$skinlist = na_dir_list($board_skin_path.'/comment');
							for ($k=0; $k<count($skinlist); $k++) {
								echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['comment_skin']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
							} 
						?>
						</select>		
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							보드 스킨 내 /comment 폴더
						</div>
					</div>
				</div>
				<?php $is_setup_skin = is_file($board_skin_path.'/comment/'.$boset['comment_skin'].'/setup.skin.php') ? true : false; ?>
				<div id="comment_skin" class="pt-2 m-0<?php echo ($is_setup_skin) ? '' : ' d-none';?>">
					<?php @include_once($board_skin_path.'/comment/'.$boset['comment_skin'].'/setup.skin.php'); ?>
				</div>
			</div>
		</div>
	</li>
</ul>