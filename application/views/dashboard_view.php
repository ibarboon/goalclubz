<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-fw fa-dashboard"></i> Dashboard
			</li>
		</ol>
	</div>
</div><!-- end .row -->
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-bar-chart"></i> ตารางคะแนน</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>อันดับ</th>
								<th>ทีม</th>
								<th>แข่ง</th>
								<th>ชนะ</th>
								<th>เสมอ</th>
								<th>แพ้</th>
								<th>ได้</th>
								<th>เสีย</th>
								<th>+/-</th>
								<th>แต้ม</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($teams as $no => $team) : ?>
							<tr>
								<td><?php echo (int)$no += 1; ?></td>
								<td><?php echo $team['team_name']; ?></td>
								<td><?php echo $team['played']; ?></td>
								<td><?php echo $team['won']; ?></td>
								<td><?php echo $team['drawn']; ?></td>
								<td><?php echo $team['lost']; ?></td>
								<td><?php echo $team['gf']; ?></td>
								<td><?php echo $team['ga']; ?></td>
								<td><?php echo $team['gd']; ?></td>
								<td><?php echo $team['points']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-bar-chart"></i> ผู้ที่ทำประตูได้มากสุด</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>อันดับ</th>
								<th>ผู้เล่น</th>
								<th>ทีม</th>
								<th>ประตู</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($players as $no => $player) : ?>
							<tr>
								<td><?php echo (int)$no += 1; ?></td>
								<td><?php echo $player['player_name']; ?></td>
								<td><?php echo $player['team_name']; ?></td>
								<td><?php echo $player['goals']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>