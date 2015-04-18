<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-fw fa-user"></i> Players
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="text-right">
			<div class="btn-group" role="group">
				<a href="javascript: void(0);" class="btn btn-default btn-edit">Edit</a>
				<a href="{delete_team_url}" class="btn btn-default">Delete</a>
			</div>
		</div>
		<br>
		<form class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="{form_action}">
			<div class="form-group">
				<label for="input-player-name" class="col-sm-3 control-label">Player Name : </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="input-player-name" id="input-player-name" value="{player_name}">
				</div>
			</div>
			<div class="form-group">
				<label for="input-team-name" class="col-sm-3 control-label">Team Name : </label>
				<div class="col-sm-9">
					<select class="form-control" name="input-team-name" id="input-team-name">
						<option>Select Team</option>
						{teams}
							<option value="{team_id}" {selected}>{team_name}</option>
						{/teams}
					</select>
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