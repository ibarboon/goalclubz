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
		<p class="text-right">
			<a class="btn btn-primary btn-sm" href="{new_player_url}">
				<i class="fa fa-fw fa-plus"></i> Add
			</a>
		</p>
		{resp_msg}
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>ผู้เล่น</th>
						<th>ทีม</th>
						<th>ประตู</th>
					</tr>
				</thead>
				<tbody>
					{players}
					<tr>
						<td><a href="{player_url}">{player_name}</a></td>
						<td>{team_name}</td>
						<td>{goals}</td>
					</tr>
					{/players}
				</tbody>
			</table>
		</div>
	</div>
</div>