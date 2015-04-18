<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-fw fa-users"></i> Teams
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<p class="text-right">
			<a class="btn btn-primary btn-sm" href="{new_team_url}">
				<i class="fa fa-fw fa-plus"></i> Add
			</a>
		</p>
		{resp_msg}
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>ทีม</th>
						<th>ผู้เล่น</th>
					</tr>
				</thead>
				<tbody>
					{teams}
					<tr>
						<td><a href="{team_url}">{team_name}</a></td>
						<td>{players}</td>
					</tr>
					{/teams}
				</tbody>
			</table>
		</div>
	</div>
</div>