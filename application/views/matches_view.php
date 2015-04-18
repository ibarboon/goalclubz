<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			{breadcrumb_list}<li>{breadcrumb}</li>{/breadcrumb_list}
		</ol><!-- end .breadcrumb -->
	</div><!-- end .col-lg-12 -->
</div><!-- end .row -->
<div class="row">
	<div class="col-lg-12">
		<p class="text-right">
			<a class="btn btn-primary btn-sm" href="{insert_form_url}">
				<i class="fa fa-fw fa-plus"></i> Add
			</a>
		</p>
		{resp_msg}
		<div class="table-responsive">
			{all_matches}
			<table class="table table-bordered table-hover table-striped table-matches">
				<thead>
					<tr>
						<th colspan="5">{match_date_th}</th>
					</tr>
				</thead>
				<tbody>
					{matches}
					<tr>
						<td class="match-time">{match_time}</td>
						<td class="home">{home}</td>
						<td class="ft"><a href="{match_url}">{home_goals} - {away_goals}</a></td>
						<td class="away">{away}</td>
						<td class="remarks">{match_remarks}</td>
					</tr>
					{/matches}
				</tbody>
			</table>
			{/all_matches}
		</div><!-- end .table-responsive -->
	</div><!-- end .col-lg-12 -->
</div><!-- end .row -->