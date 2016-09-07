<div class="form-group">
	<label for="title" class="col-md-4 control-label">
		标题
	</label>
	<div class="col-md-7">
		<input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
	</div>
</div>
<div class="form-group">
	<label for="subtitle" class="col-md-4 control-label">
		副标题
	</label>
	<div class="col-md-7">
		<input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
	</div>
</div>
<div class="form-group">
	<label for="meta_description" class="col-md-4 control-label">
		Description
	</label>
	<div class="col-md-7">
		<input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $meta_description }}">
	</div>
</div>
<div class="form-group">
	<label for="content" class="col-md-4 control-label">
		文章
	</label>
	<div class="col-md-7">
		<textarea class="form-control" name="content" id="content" rows="6">{{$content}}</textarea>
	</div>
</div>
<div class="form-group">
	<label for="page_image" class="col-md-4 control-label">
		背景图片
	</label>
	<div class="col-md-7">
		<input type="text" class="form-control" name="pic" value="{{$page_image}}">
		</br>
		<input type="file"  name="page_image" id="page_image" accept="jpg">
	</div>
</div>
<div class="form-group">
	<label for="layout" class="col-md-4 control-label">
		模板
	</label>
	<div class="col-md-7">
		<input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}">
	</div>
</div>
<div class="form-group">
	<label for="reverse_direction" class="col-md-4 control-label">
		存储方式
	</label>
	<div class="col-md-7">
		<label class="radio-inline">
			<input type="radio" name="reverse_direction" id="reverse_direction"
			@if (! $reverse_direction)
			checked="checked"
			@endif
			value="0">
			Normal
		</label>
		<label class="radio-inline">
			<input type="radio" name="reverse_direction"
			@if ($reverse_direction)
			checked="checked"
			@endif
			value="1">
			Reversed
		</label>
	</div>
</div>
