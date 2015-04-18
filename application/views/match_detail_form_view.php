<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			{breadcrumb_list}<li>{breadcrumb}</li>{/breadcrumb_list}
		</ol><!-- end .breadcrumb -->
	</div><!-- end .col-lg-12 -->
</div><!-- end .row -->
<div class="row">
	<div class="col-lg-12">
		<div class="text-right">
			<div class="btn-group" role="group">
				<a href="javascript: void(0);" class="btn btn-default btn-edit">Edit</a>
				<a href="{delete_row_url}" class="btn btn-default">Delete</a>
			</div>
		</div>
		<br>
		{resp_msg}
		<form class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="{form_action}">
			<div class="form-group">
				<label for="input-match-date" class="col-sm-3 control-label">Team : </label>
				<div class="col-sm-6">
					<label class="radio-inline">
						<input type="radio" name="radio-team" value=".{home_id}" > Home
					</label>
					<label class="radio-inline">
						<input type="radio" name="radio-team" value=".{away_id}" > away
					</label>
				</div>
			</div>
			<div class="form-group">
				<label for="input-home-id" class="col-sm-3 control-label">Player</label>
				<div class="col-sm-6">
					<select class="form-control" name="select-player-id" id="select-player-id">
						<option>Select Player</option>
						{players}
							<option value="{player_id}" class="{team_id}">{player_name}</option>
						{/players}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-goals" class="col-sm-3 control-label">Goal(s) : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="input-goals" id="input-goals">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-default">Save</button>
					<button type="button" class="btn btn-default btn-cancel">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>