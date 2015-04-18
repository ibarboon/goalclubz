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
				<label for="input-match-date" class="col-sm-3 control-label">Match Date : </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="input-match-date" id="input-match-date" value="{match_date}" placeholder="yyyy-mm-dd">
				</div>
			</div>
			<div class="form-group">
				<label for="input-match-time" class="col-sm-3 control-label">Match Time : </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="input-match-time" id="input-match-time" value="{match_time}" placeholder="hh:mm:ss">
				</div>
			</div>
			<div class="form-group">
				<label for="input-home-id" class="col-sm-3 control-label">Team (Home) : </label>
				<div class="col-sm-9">
					<select class="form-control" name="input-home-id" id="input-home-id">
						<option>Select Team</option>
						{home_teams}
							<option value="{team_id}" {selected}>{team_name}</option>
						{/home_teams}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-away-id" class="col-sm-3 control-label">Team (Away) : </label>
				<div class="col-sm-9">
					<select class="form-control" name="input-away-id" id="input-away-id">
						<option>Select Team</option>
						{away_teams}
							<option value="{team_id}" {selected}>{team_name}</option>
						{/away_teams}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-match-remarks" class="col-sm-3 control-label">Match Remarks : </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="input-match-remarks" id="input-match-remarks" value="{match_remarks}" placeholder="match remarks">
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
<div class="row">
	<div class="col-lg-12">
		<p class="text-right">
			<a class="btn btn-primary btn-sm" href="{insert_form_url}">
				<i class="fa fa-fw fa-plus"></i> Add Match Detail
			</a>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped table-matches">
				<thead>
					<tr>
						<th colspan="2">{home} : {home_goals}</th>
					</tr>
				</thead>
				<tbody>
					{home_match_detail}
						<tr>
							<td>{player_name}</td>
							<td>{player_goals}</td>
						</tr>
					{/home_match_detail}
				</tbody>
			</table>
		</div><!-- end .table-responsive -->
	</div><!-- end .col-lg-6 -->
	<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped table-matches">
				<thead>
					<tr>
						<th colspan="2">{away} : {away_goals}</th>
					</tr>
				</thead>
				<tbody>
					{away_match_detail}
						<tr>
							<td>{player_name}</td>
							<td>{player_goals}</td>
						</tr>
					{/away_match_detail}
				</tbody>
			</table>
		</div><!-- end .table-responsive -->
	</div><!-- end .col-lg-6 -->
</div><!-- end .row -->